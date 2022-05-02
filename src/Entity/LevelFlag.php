<?php

namespace App\Entity;

use App\Repository\LevelFlagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelFlagRepository::class)]
class LevelFlag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: level::class, inversedBy: 'levelFlags')]
    #[ORM\JoinColumn(nullable: false)]
    private $level;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $achieveImage;

    #[ORM\OneToMany(mappedBy: 'levelFlag', targetEntity: AchievedFlag::class, orphanRemoval: true)]
    private $achievedFlags;

    #[ORM\OneToOne(targetEntity: LevelFlagInfo::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $levelFlagInfo;

    public function __construct()
    {
        $this->achievedFlags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAchieveImage(): ?string
    {
        return $this->achieveImage;
    }

    public function setAchieveImage(?string $achieveImage): self
    {
        $this->achieveImage = $achieveImage;

        return $this;
    }

    /**
     * @return Collection<int, AchievedFlag>
     */
    public function getAchievedFlags(): Collection
    {
        return $this->achievedFlags;
    }

    public function addAchievedFlag(AchievedFlag $achievedFlag): self
    {
        if (!$this->achievedFlags->contains($achievedFlag)) {
            $this->achievedFlags[] = $achievedFlag;
            $achievedFlag->setLevelFlag($this);
        }

        return $this;
    }

    public function removeAchievedFlag(AchievedFlag $achievedFlag): self
    {
        if ($this->achievedFlags->removeElement($achievedFlag)) {
            // set the owning side to null (unless already changed)
            if ($achievedFlag->getLevelFlag() === $this) {
                $achievedFlag->setLevelFlag(null);
            }
        }

        return $this;
    }

    public function getLevelFlagInfo(): ?LevelFlagInfo
    {
        return $this->levelFlagInfo;
    }

    public function setLevelFlagInfo(LevelFlagInfo $levelFlagInfo): self
    {
        $this->levelFlagInfo = $levelFlagInfo;

        return $this;
    }
}
