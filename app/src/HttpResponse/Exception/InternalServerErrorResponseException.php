<?php

namespace App\HttpResponse\Exception;

use Throwable;
use Symfony\Component\HttpFoundation\Response;

class InternalServerErrorResponseException extends BaseResponseException
{
    public function __construct(string $message = "Internal server error.", int $code = Response::HTTP_INTERNAL_SERVER_ERROR, $errors = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $errors, $previous);
    }
}
