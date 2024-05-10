<?php

namespace App\Dto\V1\Auth;

use App\Entity\User;
use Gesdinet\JWTRefreshTokenBundle\Generator\RefreshTokenGeneratorInterface;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManagerInterface;
use Gesdinet\JWTRefreshTokenBundle\Security\Http\Authenticator\RefreshTokenAuthenticator;
use Giacomoto\Bundle\GiacomotoDtoBundle\Exception\DtoUnexpectedTypeException;
use Giacomoto\Bundle\GiacomotoDtoBundle\Interface\IDtoSerializable;
use Giacomoto\Bundle\GiacomotoDtoBundle\Transformer\DtoTransformer;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RegisterUserDtoTransformer extends DtoTransformer
{
    public function __construct(
        private readonly ParameterBagInterface $parameterBag,
        private readonly JWTTokenManagerInterface $JWTManager,
        private readonly RefreshTokenGeneratorInterface $refreshTokenGenerator,
    )
    {
    }

    /**
     * @param IDtoSerializable $entity
     * @return RegisterUserDto
     * @throws DtoUnexpectedTypeException
     */
    public function transformFromObject(IDtoSerializable $entity): RegisterUserDto
    {
        if (!$entity instanceof User) {
            throw new DtoUnexpectedTypeException('Expected type of User but got ' . get_class($entity));
        }

        $dto = new RegisterUserDto();

        $dto->accessToken = $this->JWTManager->create($entity);
        $dto->refreshToken = $this->refreshTokenGenerator->createForUserWithTtl($entity, $this->parameterBag->get('gesdinet_jwt_refresh_token.ttl'));

        return $dto;
    }
}
