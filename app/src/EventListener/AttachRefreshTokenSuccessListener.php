<?php

namespace App\EventListener;

use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class AttachRefreshTokenSuccessListener
{
    protected string $refreshTokenName;

    public function __construct(
        ContainerBagInterface $params
    )
    {
        $this->refreshTokenName = $params->get('gesdinet_jwt_refresh_token.token_parameter_name');
    }

    public function attachRefreshToken(AuthenticationSuccessEvent $event): void
    {
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $data = $event->getData();

        $data["data"][$this->refreshTokenName] = $data[$this->refreshTokenName];

        unset($data[$this->refreshTokenName]);

        $event->setData($data);
    }
}
