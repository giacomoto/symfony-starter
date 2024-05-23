<?php

namespace App\Notification\Interface;


interface INotificationProviderInterface
{
    public function send(INotificationDto $notificationDto): void;
}
