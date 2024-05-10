<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait TEntityHasGeneratedId {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    protected ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
