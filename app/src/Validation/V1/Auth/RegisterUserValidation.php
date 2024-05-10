<?php

namespace App\Validation\V1\Auth;

use App\Entity\User;
use Giacomoto\Bundle\GiacomotoValidationBundle\Class\BaseConstraint;
use Giacomoto\Bundle\GiacomotoValidationBundle\Trait\TChoiceConstraints;
use Giacomoto\Bundle\GiacomotoValidationBundle\Trait\TEmailConstraints;
use Giacomoto\Bundle\GiacomotoValidationBundle\Trait\TStringConstraints;
use Giacomoto\Bundle\GiacomotoValidationBundle\Trait\TUniqueConstraints;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;

class RegisterUserValidation extends BaseConstraint
{
    use TEmailConstraints;
    use TStringConstraints;
    use TUniqueConstraints;

    public function getConstraints(): Collection
    {
        return new Collection([
            'email' => [
                ...$this->isTypeEmail(),
                ...$this->isUnique(User::class, 'email')
            ],
            // todo password validator
            'password' => $this->isTypeString(255, 8),
        ]);
    }
}
