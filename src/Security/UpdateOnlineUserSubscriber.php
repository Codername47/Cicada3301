<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;


class UpdateOnlineUserSubscriber implements EventSubscriberInterface{
    protected EntityManagerInterface $em;
    protected Security $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->security=$security;
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['onLoginSuccess', -20]
        ];
    }
    public function onLoginSuccess(){
        $user= $this->security->getUser();
        if($user == null)
            return;
        if (!$user instanceof User)
            throw new \Exception('Unexpected user type');
        $user->setLastOnline(new \DateTime());
        $this->em->flush();
    }

}