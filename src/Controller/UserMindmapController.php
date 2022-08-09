<?php

namespace App\Controller;

use App\Entity\Level;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Security;

class UserMindmapController extends AbstractController
{
    protected Security $security;
    protected EntityManagerInterface $em;

    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->em = $em;
    }

    #[Route('/mindmap', name: 'app_user_mindmap')]
    public function index(): Response
    {
        $user = $this->security->getUser();
        if (!$user instanceof User)
            throw new UnsupportedUserException("I don't know this user type");
        $achievedLevels = $user->getAchievedLevels();
        $achievedFlags = $user->getAchievedFlags();

        return $this->render('user_mindmap/index.html.twig', [
            'flags' => $achievedFlags,
            'levels' => $achievedLevels,
            'user_info' => $user->getUserInfo()
        ]);
    }
}
