<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class JWTAuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();

        // Prepend "Bearer " if a token exists
        if (isset($data['token'])) {
            $data['token'] = 'Bearer ' . $data['token'];
        }

        $event->setData($data);
    }
}