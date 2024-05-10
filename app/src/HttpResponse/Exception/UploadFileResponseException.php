<?php

namespace App\HttpResponse\Exception;

use Throwable;
use Symfony\Component\HttpFoundation\Response;

class UploadFileResponseException extends BaseResponseException
{
    public function __construct(string $message = "Could not upload file.", int $code = Response::HTTP_INTERNAL_SERVER_ERROR, $errors = [], ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $errors, $previous);
    }
}
