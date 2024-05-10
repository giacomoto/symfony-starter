<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait TEntityHasUpdatedAt {
    #[ORM\Column(insertable: false, updatable: false, columnDefinition: 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', generated: 'ALWAYS')]
    protected \DateTimeImmutable $updatedAt;

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
