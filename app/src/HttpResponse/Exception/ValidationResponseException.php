<?php

namespace App\HttpResponse\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationResponseException extends BaseResponseException
{
    public function __construct(ConstraintViolationListInterface $constraintViolationList)
    {
        $errors = [];

        for ($i = 0; $i < $constraintViolationList->count(); $i++) {
            $violation = $constraintViolationList->get($i);

            $errors[str_replace(array('[', ']'), '',
                str_replace('][', '.', $violation->getPropertyPath())
            )] = $violation->getMessage();
        }

        parent::__construct('Validation Error', Response::HTTP_PRECONDITION_FAILED, $errors);
    }
}
