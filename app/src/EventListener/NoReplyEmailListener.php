<?php

namespace App\EventListener;

use App\Event\Auth\RegisterUserSuccessEvent;
use App\Mail\Service\NoReplyMailService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

readonly class NoReplyEmailListener implements EventSubscriberInterface
{
    public function __construct(
        private NoReplyMailService $noReplyMailService,
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RegisterUserSuccessEvent::NAME => 'onRegisterUserSuccess',
        ];
    }

    public function onRegisterUserSuccess(RegisterUserSuccessEvent $event): void {
        $this->noReplyMailService->sendRegisterUserSuccessEmail($event->getUser());
    }
}
