<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait TEntityHasLastActivityAt {
    #[ORM\Column(insertable: false, columnDefinition: 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP', generated: 'INSERT')]
    protected \DateTimeImmutable $lastActivityAt;

    /**
     * @param \DateTimeImmutable $lastActivityAt
     * @return self
     */
    public function setLastActivityAt(\DateTimeImmutable $lastActivityAt): self
    {
        $this->lastActivityAt = $lastActivityAt;
        return $this;
    }

   /**
     * @return \DateTimeImmutable
     */
    public function getLastActivityAt(): \DateTimeImmutable
    {
        return $this->lastActivityAt;
    }
}
