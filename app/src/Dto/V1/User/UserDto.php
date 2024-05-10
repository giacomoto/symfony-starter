<?php

namespace App\Dto\V1\User;

use App\Enum\EUserSerializationGroups;
use Giacomoto\Bundle\GiacomotoDtoBundle\Interface\IDtoSerializable;
use JMS\Serializer\Annotation as Serializer;

class UserDto implements IDtoSerializable
{
    #[Serializer\Type('string')]
    #[Serializer\Groups([EUserSerializationGroups::USER->value])]
    public string $email;

    #[Serializer\Type("DateTimeImmutable<'timestamp'>")]
    #[Serializer\Groups([EUserSerializationGroups::USER->value])]
    public \DateTimeImmutable $createdAt;

    #[Serializer\Type("DateTimeImmutable<'timestamp'>")]
    #[Serializer\Groups([EUserSerializationGroups::USER->value])]
    public \DateTimeImmutable $updatedAt;
}
