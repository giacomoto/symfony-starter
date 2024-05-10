<?php

namespace App\Entity;

use App\Entity\Interface\IEntityHasCreatedAt;
use App\Entity\Interface\IEntityHasGeneratedId;
use App\Entity\Interface\IEntityHasUpdatedAt;
use App\Entity\Interface\IEntityIsClonable;
use App\Entity\Trait\TEntityHasCreatedAt;
use App\Entity\Trait\TEntityHasGeneratedId;
use App\Entity\Trait\TEntityHasUpdatedAt;
use App\Entity\Trait\TEntityIsClonable;
use App\Enum\EUserRoles;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Giacomoto\Bundle\GiacomotoDtoBundle\Interface\IDtoSerializable;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements
    UserInterface,
    IDtoSerializable,
    IEntityIsClonable,
    IEntityHasCreatedAt,
    IEntityHasUpdatedAt,
    IEntityHasGeneratedId,
    PasswordAuthenticatedUserInterface
{
    use TEntityIsClonable;
    use TEntityHasCreatedAt;
    use TEntityHasUpdatedAt;
    use TEntityHasGeneratedId;

    #[ORM\Column(length: 255)]
    protected ?string $email = null;

    #[ORM\Column(length: 255)]
    protected ?string $password = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getRoles(): array
    {
//        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = EUserRoles::USER->value;

        return array_unique($roles);
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->id;
    }
}
