<?php

namespace App\HttpResponse\Exception;

use Exception;
use Throwable;
use App\HttpResponse\Interface\IBaseResponseException;

abstract class BaseResponseException extends Exception implements IBaseResponseException
{
    protected array $errors;

    public function __construct(string $message = "", int $code = 0, $errors = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
