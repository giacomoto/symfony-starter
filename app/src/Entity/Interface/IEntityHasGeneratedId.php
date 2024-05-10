<?php

namespace App\Entity\Interface;

interface IEntityHasGeneratedId
{
    public function getId(): ?int;
}
