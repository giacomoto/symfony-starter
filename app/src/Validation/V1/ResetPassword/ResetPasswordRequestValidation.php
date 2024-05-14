<?php

namespace App\Validation\V1\ResetPassword;

use Giacomoto\Bundle\GiacomotoValidationBundle\Class\BaseConstraint;
use Giacomoto\Bundle\GiacomotoValidationBundle\Trait\TEmailConstraints;
use Symfony\Component\Validator\Constraints\Collection;

class ResetPasswordRequestValidation extends BaseConstraint
{
    use TEmailConstraints;

    public function getConstraints(): Collection
    {
        return new Collection([
            'email' => $this->isTypeEmail(),
        ]);
    }
}
