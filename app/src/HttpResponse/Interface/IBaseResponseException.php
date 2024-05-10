<?php

namespace App\HttpResponse\Interface;

interface IBaseResponseException
{
    public function getErrors(): array;
}
