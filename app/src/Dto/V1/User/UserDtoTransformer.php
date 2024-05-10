<?php

namespace App\Dto\V1\User;

use App\Entity\User;
use Giacomoto\Bundle\GiacomotoDtoBundle\Exception\DtoUnexpectedTypeException;
use Giacomoto\Bundle\GiacomotoDtoBundle\Interface\IDtoSerializable;
use Giacomoto\Bundle\GiacomotoDtoBundle\Transformer\DtoTransformer;

class UserDtoTransformer extends DtoTransformer
{
    /**
     * @param IDtoSerializable $entity
     * @return UserDto
     * @throws DtoUnexpectedTypeException
     */
    public function transformFromObject(IDtoSerializable $entity): UserDto
    {
        if (!$entity instanceof User) {
            throw new DtoUnexpectedTypeException('Expected type of User but got ' . get_class($entity));
        }

        $dto = new UserDto();

        $dto->email = $entity->getEmail();
        $dto->createdAt = $entity->getCreatedAt();
        $dto->updatedAt = $entity->getUpdatedAt();

        return $dto;
    }
}
