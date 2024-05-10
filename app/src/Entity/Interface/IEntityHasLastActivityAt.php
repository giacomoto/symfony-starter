<?php

namespace App\Entity\Interface;

interface IEntityHasLastActivityAt
{
    public function getLastActivityAt(): \DateTimeImmutable;
    public function setLastActivityAt(\DateTimeImmutable $lastActivity): self;
}
