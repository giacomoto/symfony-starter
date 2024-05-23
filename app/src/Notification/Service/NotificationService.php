<?php

namespace App\Notification\Service;

use App\Notification\Exception\InvalidProviderException;
use App\Notification\Exception\NotificationException;
use App\Notification\Interface\INotificationDto;
use App\Notification\Interface\INotificationProviderInterface;
use Psr\Log\LoggerInterface;

class NotificationService
{
    private array $providers;

    public function __construct(
        iterable $providers,
        private readonly LoggerInterface $logger,
    )
    {
        foreach ($providers as $provider) {
            if (!$provider instanceof INotificationProviderInterface) {
                throw new InvalidProviderException('Invalid notification provider');
            }
            $this->providers[] = $provider;
        }
    }

    /**
     * @throws NotificationException
     */
    public function send(INotificationDto $notification): void
    {
        foreach ($this->providers as $provider) {
            try {
                $provider->send($notification);
            } catch (\Exception $e) {
                $this->logger->error('Failed to send notification: ' . $e->getMessage());
            }
        }
    }
}
