<?php

namespace App\Validation\V1\ResetPassword;

use Giacomoto\Bundle\GiacomotoValidationBundle\Class\BaseConstraint;
use Giacomoto\Bundle\GiacomotoValidationBundle\Trait\TStringConstraints;
use Symfony\Component\Validator\Constraints\Collection;

class ResetPasswordChangeValidation extends BaseConstraint
{
    use TStringConstraints;

    public function getConstraints(): Collection
    {
        return new Collection([
            // todo password validation
            'password' => $this->isTypeString(),
            'token' => $this->isTypeString(),
        ]);
    }
}
