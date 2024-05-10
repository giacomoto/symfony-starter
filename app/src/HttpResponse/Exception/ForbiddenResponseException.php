<?php

namespace App\HttpResponse\Exception;

use Throwable;
use Symfony\Component\HttpFoundation\Response;

class ForbiddenResponseException extends BaseResponseException
{
    public function __construct(string $message = "Forbidden.", int $code = Response::HTTP_FORBIDDEN, $errors = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $errors, $previous);
    }
}
