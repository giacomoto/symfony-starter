<?php

namespace App\HttpResponse\Exception;

use Throwable;
use Symfony\Component\HttpFoundation\Response;

class PreconditionFailedResponseException extends BaseResponseException
{
    public function __construct(string $message = "Precondition failed.", int $code = Response::HTTP_PRECONDITION_FAILED, $errors = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $errors, $previous);
    }
}
