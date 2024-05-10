<?php

namespace App\Dto\V1\Auth;

use App\Enum\EUserSerializationGroups;
use Giacomoto\Bundle\GiacomotoDtoBundle\Interface\IDtoSerializable;
use JMS\Serializer\Annotation as Serializer;

class RegisterUserDto implements IDtoSerializable
{
    #[Serializer\Type('string')]
    #[Serializer\Groups([EUserSerializationGroups::USER->value])]
    public string $accessToken;

    #[Serializer\Type('string')]
    #[Serializer\Groups([EUserSerializationGroups::USER->value])]
    public string $refreshToken;
}
