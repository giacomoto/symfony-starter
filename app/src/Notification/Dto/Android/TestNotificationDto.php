<?php

namespace App\Notification\Dto\Android;

use App\Notification\Dto\NotificationDto;

class TestNotificationDto extends NotificationDto
{
    const NOTIFICATION_BODY = "Body Test";
    const NOTIFICATION_TITLE = "TITLE Test";

    public function __construct()
    {
        $this
            ->setTitle(self::NOTIFICATION_TITLE)
            ->setBody(self::NOTIFICATION_BODY)
        ;
    }
}
