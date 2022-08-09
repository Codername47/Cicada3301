<?php

namespace App\Controller;

use App\Entity\JsContent;
use App\Entity\Level;
use App\Entity\LevelFlag;
use App\Services\AchieveSetter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;


class GameController extends AbstractController
{

    protected EntityManagerInterface $em;
    protected AchieveSetter $setter;

    public function __construct(AchieveSetter $setter, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->setter=$setter;
    }



    #[Route('/game', name: 'app_game')]
    public function index(): Response
    {
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    #[Route('/start', name: 'app_first_level', methods: "GET")]
    public function start(Request $request): Response
    {
        $routeName = $this->generateUrl($request->attributes->get('_route'));
        $this->setter->setLevel($routeName);
        $messages = $this->em->getRepository(Level::class)->findOneBy(['url' => $routeName])->getMessages()->toArray();
        if(count($messages) != 0)
            $randomMessage = $messages[array_rand($messages)]->getText();
        else $randomMessage = "";

        return  $this->render('game/start.html.twig',[
            'message' => $randomMessage
        ]);
    }

    #[Route('/start', name: 'app_first_level_post', methods: "POST")]
    public function ajaxPreprocessStart(Request $request): Response
    {
        if($request->get("content") == 1)
        {
            if($_POST['width'] == '330px' && $_POST['height'] == '100px') {
                $this->setter->setFlag("Первый ребус");
                return $this->json($this->em->getRepository(LevelFlag::class)->findOneBy(["name" => "Первый ребус"])->getJsContent());
            }
            else if($_POST['width'] < 300)
            {
                $this->setter->setFlag("Напугал");
                return $this->json($this->em->getRepository(LevelFlag::class)->findOneBy(["name" => "Напугал"])->getJsContent());
            }
        }
        if ($request->get("content") == 2)
        {
            if($_POST['width'] != 0)
            {
                $this->setter->setFlag("Первый шаг");
                $js = $this->em->getRepository(LevelFlag::class)->findOneBy(["name" => "Первый шаг"])->getJsContent();
                return $this->json($js);
            }
        }
        return $this->json(new JsContent());
    }

    #[Route('/busido', name: 'app_second_level', methods: "GET")]
    public function busido(Request $request): Response
    {
        $routeName = $this->generateUrl($request->attributes->get('_route'));
        if(!$this->setter->setLevel($routeName))
            return $this->redirectToRoute('app_login');
        $this->setter->setFlag("Умнее 90%");
        $messages = $this->em->getRepository(Level::class)->findOneBy(['url' => $routeName])->getMessages()->toArray();
        if(count($messages) != 0)
            $randomMessage = $messages[array_rand($messages)]->getText();
        else $randomMessage = "";

        return $this->render('game/busido.html.twig', [
            'message' => $randomMessage
        ]);
    }

    #[Route('/busido', name: 'app_second_level_post', methods: "POST")]
    public function ajaxPreprocessBusido(Request $request): Response
    {
        if($request->get("content") == 1)
        {
            $this->setter->setFlag("Невидимая кнопка");
            return $this->json($this->em->getRepository(LevelFlag::class)->findOneBy(["name" => "Невидимая кнопка"])->getJsContent());
        }
        else if ($_POST['answer'] == "42")
        {
            $this->setter->setFlag("Ответ на вопрос вселенной");
            $js = $this->em->getRepository(LevelFlag::class)->findOneBy(["name" => "Ответ на вопрос вселенной"])->getJsContent();
            return $this->json($js);
        }

        return $this->json(new JsContent());
    }

    #[Route('/nothing', name: 'app_third_level', methods: "GET")]
    public function nothing(Request $request): Response
    {
        $routeName = $this->generateUrl($request->attributes->get('_route'));
        if(!$this->setter->setLevel($routeName))
            return $this->redirectToRoute('app_login');
        $this->setter->setFlag("Яхве");
        $messages = $this->em->getRepository(Level::class)->findOneBy(['url' => $routeName])->getMessages()->toArray();
        if(count($messages) != 0)
            $randomMessage = $messages[array_rand($messages)]->getText();
        else $randomMessage = "";

        return $this->render('game/nothing.html.twig', [
            'message' => $randomMessage
        ]);
    }

    #[Route('/nothing', name: 'app_third_level_post', methods: "POST")]
    public function ajaxPreprocessNothing(Request $request): Response
    {
        if($request->get("content") == 1)
        {
            $this->setter->setFlag("You've been RickRolled");
            return $this->json($this->em->getRepository(LevelFlag::class)->findOneBy(["name" => "You've been RickRolled"])->getJsContent());
        }

        return $this->json(new JsContent());
    }

    #[Route('/cringe', name: 'app_fourth_level', methods: "GET")]
    public function cringe(Request $request): Response
    {
        $routeName = $this->generateUrl($request->attributes->get('_route'));
        if(!$this->setter->setLevel($routeName))
            return $this->redirectToRoute('app_login');
        $this->setter->setFlag("Три точки, три тире...");
        $messages = $this->em->getRepository(Level::class)->findOneBy(['url' => $routeName])->getMessages()->toArray();
        if(count($messages) != 0)
            $randomMessage = $messages[array_rand($messages)]->getText();
        else $randomMessage = "";

        return $this->render('game/cringe.html.twig',[
            'message' => $randomMessage
        ]);
    }

    #[Route('/cringe', name: 'app_fourth_level_post', methods: "POST")]
    public function ajaxPreprocessCringe(Request $request, MailerInterface $mailer): Response
    {
        if($request->get("content") == 1 && $request->get('key') == 'JF9KRMK2TTX5')
        {
            if($this->setter->setFlag("Конецъ"))
            {
                $email = (new Email())
                    ->from(new Address('codername47@yandex.ru', 'CicadaBot'))
                    ->to($this->getUser()->getEmail())
                    ->subject('Cicada3301')
                    ->text('Win!')
                    ->html('<p>Вы выиграли в нашей игре Cicada3301. Приходите в аудиторию 602, 2 к., 13.05.2022 в 11.33 за наградой</p>');

                $mailer->send($email);
            }

            return $this->json($this->em->getRepository(LevelFlag::class)->findOneBy(["name" => "Конецъ"])->getJsContent());
        }

        return $this->json(new JsContent());
    }
}
