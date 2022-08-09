<?php

namespace App\Controller;

use App\Entity\AchievedLevel;
use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\NameChangeType;
use App\Form\ResetInfoType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserSettingsController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    #[Route('/settings', name: 'app_user_settings')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $userFromDb = $em->getRepository(User::class)->find($user->getId());
        $userInfo = $user->getUserInfo();

        $formReset = $this->createForm(ResetInfoType::class);
        $tempUser = new User();
        $formChangePassword = $this->createForm(ChangePasswordType::class, $tempUser);
        $formChangeName = $this->createForm(NameChangeType::class);
        $formReset->handleRequest($request);
        $formChangeName->handleRequest($request);
        $formChangePassword->handleRequest($request);
        if($formChangeName->isSubmitted() && $formChangeName->isValid())
        {
            $userInfo->setName($formChangeName->get('name')->getData());
            $em->flush();
        }
        if($formChangePassword->isSubmitted() && $formChangePassword->isValid())
        {
            $oldPassword = $formChangePassword->get('old_plain_password')->getData();
            if(!$passwordHasher->isPasswordValid($userFromDb, $oldPassword))
                $formChangePassword->get('old_plain_password')->addError(new FormError("Old Password invalid."));
            else{
                $oldPasswordDebug = $user ->getPassword();
                $userFromDb->setPassword($passwordHasher->hashPassword($userFromDb, $tempUser->getPassword()));
                $em->persist($user);
                $em->flush();
            }
        }
        return $this->render('user_settings/index.html.twig',[
            'change_name_form' => $formChangeName->createView(),
            'reset_form' => $formReset->createView(),
            'form_change_password' => $formChangePassword->createView(),
            'user_info' => $userInfo
        ]);
    }

    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    #[Route('/reset', name: 'app_user_reset', methods: "POST")]
    public function resetData(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ResetInfoType::class);
        $form->handleRequest($request);
        if($form->get('resetButton')->isClicked()){
            /** @var User $user */
            $user = $this->getUser();
            $user->getUserInfo()->setName("anon");
            $user->getAchievedLevels()->clear();
            $user->getAchievedFlags()->clear();
            $em->flush();
            $this->addFlash('success', 'Данные уничтожены');
            return $this->redirectToRoute('app_user_main_menu');
        }
        $this->addFlash('error', 'Ошибка доступа');
        return $this->redirectToRoute('app_user_settings');
    }
}
