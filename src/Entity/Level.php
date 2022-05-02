<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\OneToMany(mappedBy: 'level', targetEntity: AchievedLevel::class, orphanRemoval: true)]
    private $achievedLevels;

    #[ORM\OneToMany(mappedBy: 'level', targetEntity: LevelFlag::class, orphanRemoval: true)]
    private $levelFlags;

    public function __construct()
    {
        $this->achievedLevels = new ArrayCollection();
        $this->levelFlags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection<int, AchievedLevel>
     */
    public function getAchievedLevels(): Collection
    {
        return $this->achievedLevels;
    }

    public function addAchievedLevel(AchievedLevel $achievedLevel): self
    {
        if (!$this->achievedLevels->contains($achievedLevel)) {
            $this->achievedLevels[] = $achievedLevel;
            $achievedLevel->setLevel($this);
        }

        return $this;
    }

    public function removeAchievedLevel(AchievedLevel $achievedLevel): self
    {
        if ($this->achievedLevels->removeElement($achievedLevel)) {
            // set the owning side to null (unless already changed)
            if ($achievedLevel->getLevel() === $this) {
                $achievedLevel->setLevel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LevelFlag>
     */
    public function getLevelFlags(): Collection
    {
        return $this->levelFlags;
    }

    public function addLevelFlag(LevelFlag $levelFlag): self
    {
        if (!$this->levelFlags->contains($levelFlag)) {
            $this->levelFlags[] = $levelFlag;
            $levelFlag->setLevel($this);
        }

        return $this;
    }

    public function removeLevelFlag(LevelFlag $levelFlag): self
    {
        if ($this->levelFlags->removeElement($levelFlag)) {
            // set the owning side to null (unless already changed)
            if ($levelFlag->getLevel() === $this) {
                $levelFlag->setLevel(null);
            }
        }

        return $this;
    }
}
