<?php

namespace App\Entity;

use App\Entity\Interface\IEntityHasGeneratedId;
use App\Entity\Trait\TEntityHasGeneratedId;
use App\Repository\ResetPasswordRequestRepository;
use Doctrine\ORM\Mapping as ORM;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestTrait;

#[ORM\Entity(repositoryClass: ResetPasswordRequestRepository::class)]
class ResetPasswordRequest implements
    ResetPasswordRequestInterface,
    IEntityHasGeneratedId
{
    use TEntityHasGeneratedId;
    use ResetPasswordRequestTrait;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct(User $user, \DateTimeInterface $expiresAt, string $selector, string $hashedToken)
    {
        $this->user = $user;
        $this->initialize($expiresAt, $selector, $hashedToken);
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
