<?php

namespace App\Notification\Exception;

class ServerUnavailableNotificationException extends NotificationException
{
    private ?\DateTimeImmutable $retryAfter = null;

    public function __construct(string $message, ?\DateTimeImmutable $retryAfter = null)
    {
        parent::__construct($message);
        $this->retryAfter = $retryAfter;
    }

    public function retryAfter(): ?\DateTimeImmutable
    {
        return $this->retryAfter;
    }
}
