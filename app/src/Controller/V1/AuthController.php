<?php

namespace App\Controller\V1;

use App\Crud\V1\User\CreateUserCrud;
use App\Dto\V1\Auth\RegisterUserDtoTransformer;
use App\Dto\V1\User\UserDtoTransformer;
use App\Enum\EUserSerializationGroups;
use App\Event\Auth\RegisterUserSuccessEvent;
use App\HttpResponse\Exception\BaseResponseException;
use App\HttpResponse\Exception\ValidationResponseException;
use App\Validation\V1\Auth\RegisterUserValidation;
use Giacomoto\Bundle\GiacomotoValidationBundle\Service\ValidationService;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends V1Controller
{
    /**
     * @throws BaseResponseException
     */
    public function register(
        Request                    $request,
        CreateUserCrud             $createUserCrud,
        ValidationService          $validationService,
        EventDispatcherInterface   $eventDispatcher,
        RegisterUserDtoTransformer $registerUserDtoTransformer,
    ): JsonResponse
    {
        $body = $request->toArray();

        $this->addSerializationGroup(EUserSerializationGroups::USER);

        if ($errors = $validationService->getErrors($body, RegisterUserValidation::class)) {
            throw new ValidationResponseException($errors);
        }

        $user = $createUserCrud->createUserFromRegister($body);

        $eventDispatcher->dispatch(new RegisterUserSuccessEvent($user), RegisterUserSuccessEvent::NAME);

        return $this->respond($registerUserDtoTransformer->transformFromObject($user), Response::HTTP_CREATED);
    }

    public function getMe(
        UserDtoTransformer $userDtoTransformer,
    ): JsonResponse
    {
        $this->addSerializationGroup(EUserSerializationGroups::USER);

        $user = $this->getLoggedUser();

        return $this->respond($userDtoTransformer->transformFromObject($user));
    }
}
