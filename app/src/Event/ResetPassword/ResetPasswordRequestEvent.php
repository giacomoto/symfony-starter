<?php

namespace App\Event\ResetPassword;

use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;

class ResetPasswordRequestEvent extends Event
{
    public const NAME = 'reset_password.request';

    public function __construct(
        private readonly User $user,
        private readonly ResetPasswordToken $resetPasswordToken
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

    /**
     * @return ResetPasswordToken
     */
    public function getResetPasswordToken(): ResetPasswordToken {
        return $this->resetPasswordToken;
    }
}
