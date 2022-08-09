<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CheckVerifiedUserSubscriber implements EventSubscriberInterface{
    public static function getSubscribedEvents()
    {
        return [
            CheckPassportEvent::class => ['onCheckPassport', -10]
        ];
    }
    public static function onCheckPassport(CheckPassportEvent $event){
        $passport = $event->getPassport();
        $user = $passport->getUser();
        if (!$user instanceof User)
            throw new \Exception('Unexpected user type');
        if (!$user->isVerified()) {
            throw new CustomUserMessageAuthenticationException(
                'Please verify your account before logging in.'
            );
        }
    }

}