<?php

namespace App\Crud\V1\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class CreateUserCrud
{
    public function __construct(
        private UserRepository              $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
    )
    {
    }

    public function createUserFromRegister(array $body): User
    {
        $user = new User();
        $user
            ->setEmail($body['email'])
            ->setPassword($this->passwordHasher->hashPassword($user, $body['password']));

        $this->userRepository->save($user, true);
        return $user;
    }
}
