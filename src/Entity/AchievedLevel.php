<?php

namespace App\Entity;

use App\Repository\AchievedLevelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchievedLevelRepository::class)]
class AchievedLevel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: user::class, inversedBy: 'achievedLevels')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: Level::class, inversedBy: 'achievedLevels')]
    #[ORM\JoinColumn(nullable: false)]
    private $level;

    #[ORM\Column(type: 'dateinterval')]
    private $totalTime;

    #[ORM\Column(type: 'datetime')]
    private $dateAchieve;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getTotalTime(): ?\DateInterval
    {
        return $this->totalTime;
    }

    public function setTotalTime(\DateInterval $totalTime): self
    {
        $this->totalTime = $totalTime;

        return $this;
    }

    public function getDateAchieve(): ?\DateTimeInterface
    {
        return $this->dateAchieve;
    }

    public function setDateAchieve(\DateTimeInterface $dateAchieve): self
    {
        $this->dateAchieve = $dateAchieve;

        return $this;
    }
}
