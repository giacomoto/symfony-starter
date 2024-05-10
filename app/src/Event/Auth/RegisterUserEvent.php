<?php

namespace App\Event\Auth;

use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class RegisterUserEvent extends Event
{
    public const NAME = 'auth.register_user';

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
