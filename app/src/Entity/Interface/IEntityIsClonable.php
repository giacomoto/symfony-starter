<?php

namespace App\Entity\Interface;

interface IEntityIsClonable
{
    public function clone(): self;
}
