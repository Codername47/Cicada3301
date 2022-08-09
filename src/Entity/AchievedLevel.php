<?php

namespace App\Entity;

use App\Repository\AchievedLevelRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Validator as AcmeAsset;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[AcmeAsset\NewLevelConstraint]
#[ORM\Entity(repositoryClass: AchievedLevelRepository::class)]
#[UniqueEntity( fields: ['user', 'level'], message: 'This level already reached by this user.', errorPath: 'port') ]
class AchievedLevel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'achievedLevels')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;


    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: Level::class, inversedBy: 'achievedLevels')]
    private $level;

    #[ORM\Column(type: 'dateinterval')]
    private $totalTime;

    #[ORM\Column(type: 'datetime', columnDefinition: "DATETIME on update CURRENT_TIMESTAMP")]
    private $dateAchieve;

    public function __construct()
    {
        $this->dateAchieve = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->getUser()->getUsername() ." (". $this->getLevel()->getName().")";
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

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getTotalTime(): string
    {
        return $this->totalTime->format("%y years, %m month, %d days, %h hours, %m minutes, %s seconds");
    }

    public function calculateTotalTime(): self
    {
        $achieveTime = $this->getDateAchieve();
        $dateOfReg = $this->getUser()->getUserInfo()->getRegistrationDate();
        $this->totalTime = $achieveTime->diff($dateOfReg);
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
