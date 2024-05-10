<?php

namespace App\HttpResponse\Exception;

use Throwable;
use Symfony\Component\HttpFoundation\Response;

class GeneralResponseException extends BaseResponseException
{
    public function __construct(string $message = "Bad request.", int $code = Response::HTTP_BAD_REQUEST, $errors = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $errors, $previous);
    }
}
