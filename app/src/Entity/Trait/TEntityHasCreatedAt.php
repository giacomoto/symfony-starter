<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait TEntityHasCreatedAt {
    #[ORM\Column(insertable: false, updatable: false, columnDefinition: 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP', generated: 'INSERT')]
    protected \DateTimeImmutable $createdAt;

   /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
