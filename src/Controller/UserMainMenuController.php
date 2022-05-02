<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserMainMenuController extends AbstractController
{
    #[Route('/main', name: 'app_user_main_menu')]
    public function index(): Response
    {
        return $this->render('user_main_menu/index.html.twig', [
            'controller_name' => 'UserMainMenuController',
        ]);
    }
}
