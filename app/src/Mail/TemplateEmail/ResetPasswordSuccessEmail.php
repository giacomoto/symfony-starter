<?php

namespace App\Mail\TemplateEmail;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;

class ResetPasswordSuccessEmail
{
    const NAME = 'Reset Password Success';
    const SUBJECT = 'Your password reset request';
    const EMAIL_TEMPLATE = 'reset_password/success_email.html.twig';

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

    public function getEmail(): Email
    {
        return (new TemplatedEmail())
            ->from($this->from)
            ->to($this->to)
            ->subject(self::SUBJECT)
            ->htmlTemplate(self::EMAIL_TEMPLATE);
    }
}
