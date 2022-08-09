<?php

namespace App\Services;

use App\Entity\AchievedFlag;
use App\Entity\AchievedLevel;
use App\Entity\Level;
use App\Entity\LevelFlag;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Security;

class AchieveSetter
{
    protected EntityManagerInterface $em;
    protected Security $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em=$em;
        $this->security=$security;
    }

    public function setLevel(string $routeName)
    {
        $user = $this->security->getUser();
        if (!$user instanceof User)
            throw new UnsupportedUserException('Unknown type of user');
        $currentLevel = $this->em->getRepository(Level::class)->findOneBy(["url" => $routeName]);
        foreach ($user->getAchievedLevels() as $level)
        {
            if ($level->getLevel() === $currentLevel)
                return true;
        }
        foreach ($user->getAchievedLevels() as $level)
        {
            if($level->getLevel()->getNextLevel() === $currentLevel)
            {
                $achievedLevel = new AchievedLevel();
                $achievedLevel->setUser($user);
                $achievedLevel->setLevel($currentLevel);
                $achievedLevel->calculateTotalTime();
                $this->em->persist($achievedLevel);
                $this->em->flush();
                return true;
            }
        }
        if (($routeName == "/start"))
        {
            $achievedLevel = new AchievedLevel();
            $achievedLevel->setUser($user);
            $achievedLevel->setLevel($currentLevel);
            $achievedLevel->calculateTotalTime();
            $this->em->persist($achievedLevel);
            $this->em->flush();
            return true;
        }
        return false;

    }

    public function setFlag(string $flagName)
    {
        $user = $this->security->getUser();
        if (!$user instanceof User)
            throw new UnsupportedUserException('Unknown type of user');
        $repo = $this->em->getRepository(LevelFlag::class);
        $currentFlag = $repo->findOneBy(['name' => $flagName]);
        if ($currentFlag == null)
            return $this->redirectToRoute('app_login');
        foreach ($user->getAchievedFlags() as $flag)
        {
            if($flag->getLevelFlag() === $currentFlag)
                return false;
        }
        foreach ($user->getAchievedLevels() as $level)
        {
            if ($level->getLevel() === $currentFlag->getLevel())
            {
                $achievedFlag = new AchievedFlag();
                $achievedFlag->setUser($user);
                $achievedFlag->setLevelFlag($currentFlag);
                $achievedFlag->calculateTotalTime();
                $this->em->persist($achievedFlag);
                $this->em->flush();
                return true;
            }
        }
        return false;
    }
}