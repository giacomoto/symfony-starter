<?php

namespace App\Entity\Interface;

interface IEntityHasCreatedAt
{
    public function getCreatedAt(): \DateTimeImmutable;
}
