<?php

namespace App\Event\ResetPassword;

use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class ResetPasswordSuccessEvent extends Event
{
    public const NAME = 'reset_password.success';

    public function __construct(
        private readonly User $user,
    )
    {
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
