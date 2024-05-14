<?php

namespace App\Controller\V1;

use App\Crud\V1\User\UpdateUserCrud;
use App\Entity\User;
use App\Enum\EUserSerializationGroups;
use App\Event\ResetPassword\ResetPasswordRequestEvent;
use App\Event\ResetPassword\ResetPasswordSuccessEvent;
use App\HttpResponse\Exception\InternalServerErrorResponseException;
use App\HttpResponse\Exception\NotFoundResponseException;
use App\HttpResponse\Exception\ValidationResponseException;
use App\Repository\UserRepository;
use App\Validation\V1\ResetPassword\ResetPasswordChangeValidation;
use App\Validation\V1\ResetPassword\ResetPasswordRequestValidation;
use Giacomoto\Bundle\GiacomotoValidationBundle\Service\ValidationService;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

class ResetPasswordController extends V1Controller
{
    use ResetPasswordControllerTrait;

    /**
     * @throws ValidationResponseException
     * @throws InternalServerErrorResponseException
     */
    public function request(
        Request                      $request,
        UserRepository               $userRepository,
        ValidationService            $validationService,
        EventDispatcherInterface     $eventDispatcher,
        ResetPasswordHelperInterface $resetPasswordHelper,
    ): JsonResponse
    {
        $body = $request->toArray();

        $this->addSerializationGroup(EUserSerializationGroups::USER);

        if ($errors = $validationService->getErrors($body, ResetPasswordRequestValidation::class)) {
            throw new ValidationResponseException($errors);
        }

        if (!$user = $userRepository->findOneBy(['email' => $body['email']])) {
            return $this->respond([]);
        }

        try {
            $resetToken = $resetPasswordHelper->generateResetToken($user);
        } catch (ResetPasswordExceptionInterface $e) {
            // return general error for security reason
            throw new InternalServerErrorResponseException('Cannot generate reset token');
        }

        $eventDispatcher->dispatch(new ResetPasswordRequestEvent($user, $resetToken), ResetPasswordRequestEvent::NAME);

        return $this->respond([]);
    }

    /**
     * @throws ValidationResponseException
     * @throws NotFoundResponseException
     */
    public function change(
        Request                      $request,
        UpdateUserCrud               $updateUserCrud,
        ValidationService            $validationService,
        EventDispatcherInterface     $eventDispatcher,
        ResetPasswordHelperInterface $resetPasswordHelper,
    ): JsonResponse
    {
        $body = $request->toArray();

        $this->addSerializationGroup(EUserSerializationGroups::USER);

        if ($errors = $validationService->getErrors($body, ResetPasswordChangeValidation::class)) {
            throw new ValidationResponseException($errors);
        }

        try {
            $user = $resetPasswordHelper->validateTokenAndFetchUser($body['token']);
            assert($user instanceof User);
        } catch (ResetPasswordExceptionInterface $e) {
            throw new NotFoundResponseException('User not found');
        }

        $resetPasswordHelper->removeResetRequest($body['token']);

        $updateUserCrud->updatePassword($user, $body['password']);

        $eventDispatcher->dispatch(new ResetPasswordSuccessEvent($user), ResetPasswordSuccessEvent::NAME);

        return $this->respond([], Response::HTTP_NO_CONTENT);
    }
}