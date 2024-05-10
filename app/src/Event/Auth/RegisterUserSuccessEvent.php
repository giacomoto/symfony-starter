<?php

namespace App\Event\Auth;

use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class RegisterUserSuccessEvent extends Event
{
    public const NAME = 'auth.register_user_success';

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
