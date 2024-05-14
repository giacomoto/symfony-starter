<?php

namespace App\Crud\V1\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UpdateUserCrud
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
    )
    {
    }

    public function updatePassword(User $user, string $password): User
    {
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->flush();
        return $user;
    }
}
