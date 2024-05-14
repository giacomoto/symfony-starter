<?php

namespace App\Mail\TemplateEmail;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;

class ResetPasswordRequestEmail
{
    const NAME = 'Reset Password Request';
    const SUBJECT = 'Your password reset request';
    const EMAIL_TEMPLATE = 'reset_password/reset_email.html.twig';

    private Address $from;
    private Address $to;

    public function setFrom(Address $from): self
    {
        $this->from = $from;
        return $this;
    }

    public function setTo(Address $to): self
    {
        $this->to = $to;
        return $this;
    }

    public function getEmail(ResetPasswordToken $resetToken): Email
    {
        return (new TemplatedEmail())
            ->from($this->from)
            ->to($this->to)
            ->subject(self::SUBJECT)
            ->htmlTemplate(self::EMAIL_TEMPLATE)
            ->context([
                'resetToken' => $resetToken,
            ]);
    }
}
