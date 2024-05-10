<?php

namespace App\Controller;

use App\Entity\User;
use App\Enum\EUserSerializationGroups;
use Giacomoto\Bundle\GiacomotoDtoBundle\Service\JMSSerializerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    protected array $serializationGroups = [];

    public function __construct(
        protected readonly JMSSerializerService $serializerService
    )
    {
    }

    protected function getLoggedUser(): User
    {
        $user = $this->getUser();

        assert($user instanceof User);

        return $user;
    }

    protected function addSerializationGroup(EUserSerializationGroups $serializationGroup): void
    {
        $this->serializationGroups[] = $serializationGroup->value;
    }

    protected function respond(mixed $data, $status = Response::HTTP_OK, ?array $metadata = null): JsonResponse
    {
        return new JsonResponse(json_decode(
            $this->serializerService
                ->setGroups($this->serializationGroups)
                ->serialize(["data" => $data, '_meta' => $metadata])
            , true), $status);
    }
}
