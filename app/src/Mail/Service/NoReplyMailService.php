<?php

namespace App\Mail\Service;

use App\Entity\User;
use App\Mail\TemplateEmail\RegisterUserSuccessEmail;
use App\Mail\TemplateEmail\ResetPasswordRequestEmail;
use App\Mail\TemplateEmail\ResetPasswordSuccessEmail;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;

class NoReplyMailService
{
    private Address $noReplayAddress;

    public function __construct(
        string                           $emailName,
        string                           $emailAddress,
        private readonly MailerInterface $mailer,
        private readonly LoggerInterface $logger,
    )
    {
        $this->noReplayAddress = new Address($emailAddress, $emailName);
    }

    public function sendRegisterUserSuccessEmail(User $user): bool
    {
        $email = (new RegisterUserSuccessEmail())
            ->setFrom($this->noReplayAddress)
            ->setTo(new Address($user->getEmail()));

        return $this->send($email->getEmail(), $email::NAME);
    }

    public function sendResetPasswordRequestEmail(User $user, ResetPasswordToken $resetToken): bool
    {
        $email = (new ResetPasswordRequestEmail())
            ->setFrom($this->noReplayAddress)
            ->setTo(new Address($user->getEmail()));

        return $this->send($email->getEmail($resetToken), $email::NAME);
    }

    public function sendResetPasswordSuccessEmail(User $user): bool
    {
        $email = (new ResetPasswordSuccessEmail())
            ->setFrom($this->noReplayAddress)
            ->setTo(new Address($user->getEmail()));

        return $this->send($email->getEmail(), $email::NAME);
    }

    private function send(Email $email, string $emailName): bool
    {
        try {
            $this->mailer->send($email);
            return true;
        } catch (TransportExceptionInterface $exception) {
            $this->logger->error("Send '$emailName' Error: {$exception->getMessage()}");
            return false;
        }
    }
}
