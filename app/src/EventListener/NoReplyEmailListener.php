<?php

namespace App\EventListener;

use App\Event\ResetPassword\ResetPasswordRequestEvent;
use App\Event\ResetPassword\ResetPasswordSuccessEvent;
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
            ResetPasswordRequestEvent::NAME => 'onResetPasswordRequest',
            ResetPasswordSuccessEvent::NAME => 'onResetPasswordSuccess',
        ];
    }

    public function onRegisterUserSuccess(RegisterUserSuccessEvent $event): void
    {
        $this->noReplyMailService->sendRegisterUserSuccessEmail($event->getUser());
    }

    public function onResetPasswordRequest(ResetPasswordRequestEvent $event): void {
        $this->noReplyMailService->sendResetPasswordRequestEmail($event->getUser(), $event->getResetPasswordToken());
    }

    public function onResetPasswordSuccess(ResetPasswordSuccessEvent $event): void {
        $this->noReplyMailService->sendResetPasswordSuccessEmail($event->getUser());
    }
}
