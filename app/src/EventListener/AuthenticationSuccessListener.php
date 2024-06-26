<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(
        AuthenticationSuccessEvent $event,
    )
    {
        $data = $event->getData();
        $event->setData(["data" => ["accessToken" => $data["token"]], "_meta" => null]);
    }
}
