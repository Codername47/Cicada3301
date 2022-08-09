<?php

namespace App\DataFixtures;

use App\Entity\Content;
use App\Entity\ContentType;
use App\Entity\JsContent;
use App\Entity\Level;
use App\Entity\LevelFlag;
use App\Entity\Message;
use App\Entity\User;
use App\Entity\UserInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $repo = $manager->getRepository(User::class);
        $user = new User();
        $user->setUsername("admin");
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setIsVerified(true);
        $user->setEmail("admin@admin.com");
        $user->setUserInfo(new UserInfo());
        $repo->upgradePassword($user, "admin");
        $manager->persist($user);

        $user1 = new User();
        $user1->setUsername("username");
        $user1->setIsVerified(true);
        $user1->setEmail("username@username.com");
        $user1->setUserInfo(new UserInfo());
        $repo->upgradePassword($user1, "username");
        $manager->persist($user1);
        //JS

        $js1 = new JsContent();
        $js1->setUrl("GameFiles/js/lQheWpDw.js");
        $js1->setTimeout(0);
        $manager->persist($js1);

        $js2 = new JsContent();
        $js2->setUrl("GameFiles/js/CZFrkjuQ.js");
        $js2->setTimeout(0);
        $manager->persist($js2);

        $js3 = new JsContent();
        $js3->setUrl("GameFiles/js/kk8RlzPl.js");
        $js3->setTimeout(100);
        $manager->persist($js3);

        $js4 = new JsContent();
        $js4->setUrl("GameFiles/js/Yi1NHI341F.js");
        $js4->setTimeout(0);
        $manager->persist($js4);

        $js5 = new JsContent();
        $js5->setUrl("GameFiles/js/DUiD2Wk2.js");
        $js5->setTimeout(0);
        $manager->persist($js5);

        $js6 = new JsContent();
        $js6->setUrl("GameFiles/js/NYtf41YG1oS.js");
        $js6->setTimeout(5000);
        $manager->persist($js6);

        $js7 = new JsContent();
        $js7->setUrl("GameFiles/js/YUGe6yuE3W.js");
        $js7->setTimeout(1000);
        $manager->persist($js7);

        //ContentType

        $ct1 = new ContentType();
        $ct1->setName("img");
        $ct1->setIcon("icons/img.png");
        $manager->persist($ct1);

        $ct2 = new ContentType();
        $ct2->setName("txt");
        $ct2->setIcon("icons/txt.png");
        $manager->persist($ct2);

        $ct3 = new ContentType();
        $ct3->setName("mp3");
        $ct3->setIcon("icons/mp3.png");
        $manager->persist($ct3);

        //Levels

        $lvl1 = new Level();
        $lvl1->setName("start");
        $lvl1->setUrl("/start");

        $lvl2 = new Level();
        $lvl2->setName("busido");
        $lvl2->setUrl("/busido");

        $lvl3 = new Level();
        $lvl3->setName("nothing");
        $lvl3->setUrl("/nothing");

        $lvl4 = new Level();
        $lvl4->setName("cringe");
        $lvl4->setUrl("/cringe");

        $lvl1->setNextLevel($lvl2);
        $lvl2->setNextLevel($lvl3);
        $lvl3->setNextLevel($lvl4);

        $manager->persist($lvl1);
        $manager->persist($lvl2);
        $manager->persist($lvl3);
        $manager->persist($lvl4);

        //Level Flags

        $lf1 = new LevelFlag();
        $lf1->setName("Напугал");
        $lf1->setAchieveImage("GameFiles/ach/scare.jpg");
        $lf1->setLevel($lvl1);
        $lf1->setJsContent($js1);
        $manager->persist($lf1);

        $lf2 = new LevelFlag();
        $lf2->setName("Первый ребус");
        $lf2->setAchieveImage("GameFiles/ach/caesar.png");
        $lf2->setLevel($lvl1);
        $lf2->setJsContent($js2);
        $manager->persist($lf2);

        $lf3 = new LevelFlag();
        $lf3->setName("Первый шаг");
        $lf3->setAchieveImage("GameFiles/ach/first_step.jpg");
        $lf3->setLevel($lvl1);
        $lf3->setJsContent($js3);
        $manager->persist($lf3);

        $lf4 = new LevelFlag();
        $lf4->setName("Умнее 90%");
        $lf4->setAchieveImage("GameFiles/ach/ninety.png");
        $lf4->setLevel($lvl1);
        $manager->persist($lf4);

        $lf5 = new LevelFlag();
        $lf5->setName("Невидимая кнопка");
        $lf5->setAchieveImage("GameFiles/ach/button.jpg");
        $lf5->setLevel($lvl2);
        $lf5->setJsContent($js4);
        $manager->persist($lf5);

        $lf6 = new LevelFlag();
        $lf6->setName("Ответ на вопрос вселенной");
        $lf6->setAchieveImage("GameFiles/ach/forty_two.jpg");
        $lf6->setLevel($lvl2);
        $lf6->setJsContent($js5);
        $manager->persist($lf6);

        $lf7 = new LevelFlag();
        $lf7->setName("Яхве");
        $lf7->setAchieveImage("GameFiles/ach/jhwh.jpg");
        $lf7->setLevel($lvl2);
        $manager->persist($lf7);

        $lf8 = new LevelFlag();
        $lf8->setName("You've been RickRolled");
        $lf8->setAchieveImage("GameFiles/ach/rick.jpg");
        $lf8->setLevel($lvl3);
        $lf8->setJsContent($js6);
        $manager->persist($lf8);

        $lf9 = new LevelFlag();
        $lf9->setName("Три точки, три тире...");
        $lf9->setAchieveImage("GameFiles/ach/morse.png");
        $lf9->setLevel($lvl3);
        $manager->persist($lf9);

        $lf10 = new LevelFlag();
        $lf10->setName("Конецъ");
        $lf10->setAchieveImage("GameFiles/ach/gold.jpg");
        $lf10->setLevel($lvl4);
        $lf10->setJsContent($js7);
        $manager->persist($lf10);

        //message

        $msg1 = new Message();
        $msg1->setText("Впервые здесь?");
        $msg1->setLevel($lvl1);
        $manager->persist($msg1);

        $msg2 = new Message();
        $msg2->setText("Если задача перед вами слишком сложная, задумайтесь, стоит ли её решать?");
        $msg2->setLevel($lvl1);
        $manager->persist($msg2);

        $msg3 = new Message();
        $msg3->setText("Самый длинный путь оказывается самым коротким, это относится не только к дорогам.");
        $msg3->setLevel($lvl2);
        $manager->persist($msg3);

        $msg4 = new Message();
        $msg4->setText("Будь верен текущей мысли и не отвлекайся.");
        $msg4->setLevel($lvl2);
        $manager->persist($msg4);

        $msg5 = new Message();
        $msg5->setText("Впереди опасность!");
        $msg5->setLevel($lvl3);
        $manager->persist($msg5);

        //Content

        $c1 = new Content();
        $c1->setUrl("GameFiles/img/negative.jpg");
        $c1->setContentType($ct1);
        $c1->setLevelFlag($lf1);
        $manager->persist($c1);

        $c2 = new Content();
        $c2->setUrl("GameFiles/mp3/scr.mp3");
        $c2->setContentType($ct3);
        $c2->setLevelFlag($lf1);
        $manager->persist($c2);

        $c3 = new Content();
        $c3->setUrl("GameFiles/txt/UYehni6Eyh.txt");
        $c3->setContentType($ct2);
        $c3->setLevelFlag($lf1);
        $manager->persist($c3);

        $c4 = new Content();
        $c4->setUrl("GameFiles/img/TheEnd.jpg");
        $c4->setContentType($ct1);
        $c4->setLevelFlag($lf2);
        $manager->persist($c4);

        $c5 = new Content();
        $c5->setUrl("GameFiles/img/J3WkGMe1aa4.jpg");
        $c5->setContentType($ct1);
        $c5->setLevelFlag($lf3);
        $manager->persist($c5);

        $c6 = new Content();
        $c6->setUrl("GameFiles/txt/78YhuyE8e2.txt");
        $c6->setContentType($ct2);
        $c6->setLevelFlag($lf3);
        $manager->persist($c6);

        $c7 = new Content();
        $c7->setUrl("GameFiles/img/jak1.jpg");
        $c7->setContentType($ct1);
        $c7->setLevelFlag($lf5);
        $manager->persist($c7);

        $c8 = new Content();
        $c8->setUrl("GameFiles/img/jak2.jpg");
        $c8->setContentType($ct1);
        $c8->setLevelFlag($lf5);
        $manager->persist($c8);

        $c9 = new Content();
        $c9->setUrl("GameFiles/img/jak3.png");
        $c9->setContentType($ct1);
        $c9->setLevelFlag($lf5);
        $manager->persist($c9);

        $c10 = new Content();
        $c10->setUrl("GameFiles/txt/4 letters (GOD help you).txt");
        $c10->setContentType($ct2);
        $c10->setLevelFlag($lf6);
        $manager->persist($c10);

        $c11 = new Content();
        $c11->setUrl("GameFiles/img/loading.gif");
        $c11->setContentType($ct1);
        $c11->setLevelFlag($lf9);
        $manager->persist($c11);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
