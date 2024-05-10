<?php

namespace App\HttpResponse\Exception;

use Throwable;
use Symfony\Component\HttpFoundation\Response;

class NotFoundResponseException extends BaseResponseException
{
    public function __construct(string $message = "Not Found.", int $code = Response::HTTP_NOT_FOUND, $errors = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $errors, $previous);
    }
}
