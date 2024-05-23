<?php

namespace App\Controller\V1;

use App\Dto\V1\User\UserDtoTransformer;
use App\Enum\EUserSerializationGroups;
use App\Notification\Dto\Android\TestNotificationDto;
use App\Notification\Exception\NotificationException;
use App\Notification\Service\NotificationService;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestController extends V1Controller
{
    /**
     * @throws NotificationException
     */
    public function test(
        UserDtoTransformer  $userDtoTransformer,
        NotificationService $notificationService,
    ): JsonResponse
    {
        $this->addSerializationGroup(EUserSerializationGroups::USER);

        $user = $this->getLoggedUser();

        $notificationService->send((new TestNotificationDto())
            ->setData(["asd" => 123])
            ->setDeviceToken('asd'));

        return $this->respond($userDtoTransformer->transformFromObject($user));
    }
}
