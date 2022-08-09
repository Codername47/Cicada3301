<?php

namespace App\Controller;

use App\Entity\Level;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Security;

class UserFragmentsController extends AbstractController
{

    protected Security $security;
    protected EntityManagerInterface $em;

    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->security = $security;
    }

    #[Route('/fragments', name: 'app_user_fragments', methods: "GET")]
    public function index(): Response
    {
        $user=$this->security->getUser();
        if(!$user instanceof User)
            throw new UnsupportedUserException("I dont cnow this type of User!");
        $acLevels = $user->getAchievedLevels();
        $acFlags = $user->getAchievedFlags();
        return $this->render('user_fragments/index.html.twig', [
            'achievedLevels' => $acLevels,
            'achievedFlags' => $acFlags,
            'user_info' => $user->getUserInfo()
        ]);
    }

    #[Route('/fragments', name: 'app_user_fragments_post', methods: "POST")]
    public function Find(Request $request): Response
    {
        $currentLevelName = $request->get('level');
        $user=$this->security->getUser();
        $currentLevel = $this->em->getRepository(Level::class)->findOneBy(["name" => $currentLevelName]);
        if (!$currentLevel) return $this->json([]);
        if(!$user instanceof User)
            throw new UnsupportedUserException("I dont know this type of User!");
        $userLevels = $user->getAchievedLevels();
        foreach ($userLevels as $level)
        {
            if ($level->getLevel() == $currentLevel)
            {

                $items = [];
                $acflags = $user->getAchievedFlags();
                foreach ($acflags as $acFlag)
                {
                    if($acFlag->getLevelFlag()->getLevel() == $currentLevel)
                        $items = $items + $acFlag->getLevelFlag()->getContents()->toArray();
                }
                return $this->json($items);
            }
        }
        return $this->json([]);
    }
}
