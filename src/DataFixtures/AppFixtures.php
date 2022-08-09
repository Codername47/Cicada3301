<?php

namespace App\DataFixtures;

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
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
