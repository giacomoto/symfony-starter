<?php

namespace App\Entity\Interface;

interface IEntityHasUpdatedAt
{
    public function getUpdatedAt(): \DateTimeImmutable;
}
