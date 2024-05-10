<?php

namespace App\HttpResponse\Exception;

use Throwable;
use Symfony\Component\HttpFoundation\Response;

class UnprocessableEntityResponseException extends BaseResponseException
{
    public function __construct(string $message = "Unprocessable entity.", int $code = Response::HTTP_UNPROCESSABLE_ENTITY, $errors = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $errors, $previous);
    }
}
