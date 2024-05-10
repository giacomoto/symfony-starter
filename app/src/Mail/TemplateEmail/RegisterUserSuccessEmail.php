<?php

namespace App\Mail\TemplateEmail;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class RegisterUserSuccessEmail
{
    const NAME = 'Register User Success';
    const SUBJECT = 'Welcome';
    const EMAIL_TEMPLATE = 'auth/register_user_success_email.html.twig';

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
