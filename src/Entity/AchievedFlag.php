<?php

namespace App\Entity;

use App\Repository\AchievedFlagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchievedFlagRepository::class)]
class AchievedFlag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'achievedFlags')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: LevelFlag::class, inversedBy: 'achievedFlags')]
    #[ORM\JoinColumn(nullable: false)]
    private $levelFlag;

    #[ORM\Column(type: 'datetime')]
    private $dateAchieve;

    #[ORM\Column(type: 'dateinterval')]
    private $totalTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLevelFlag(): ?LevelFlag
    {
        return $this->levelFlag;
    }

    public function setLevelFlag(?LevelFlag $levelFlag): self
    {
        $this->levelFlag = $levelFlag;

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

    public function getTotalTime(): ?\DateInterval
    {
        return $this->totalTime;
    }

    public function setTotalTime(\DateInterval $totalTime): self
    {
        $this->totalTime = $totalTime;

        return $this;
    }
}
