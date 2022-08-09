<?php

namespace App\Entity;

use App\Repository\LevelFlagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: LevelFlagRepository::class)]
class LevelFlag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Level::class, inversedBy: 'levelFlags')]
    #[ORM\JoinColumn(nullable: false)]
    private $level;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $achieveImage;

    #[ORM\OneToMany(mappedBy: 'levelFlag', targetEntity: AchievedFlag::class, orphanRemoval: true)]
    private $achievedFlags;

    #[ORM\OneToOne(inversedBy: 'levelFlag', targetEntity: JsContent::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private $jsContent;

    #[ORM\OneToMany(mappedBy: 'levelFlag', targetEntity: Content::class, orphanRemoval: true)]
    private $contents;

    public function __toString(): string
    {
        return $this->name." (".$this->getLevel()->getName().")";
    }

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



    public function getJsContent(): ?jsContent
    {
        return $this->jsContent;
    }

    public function setJsContent(jsContent $jsContent): self
    {
        $this->jsContent = $jsContent;

        return $this;
    }

    /**
     * @return Collection<int, Content>
     */
    public function getContents(): ?Collection
    {
        return $this->contents;
    }

    public function addContent(Content $content): self
    {
        if (!$this->contents->contains($content)) {
            $this->contents[] = $content;
            $content->setLevelFlag($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->contents->removeElement($content)) {
            // set the owning side to null (unless already changed)
            if ($content->getLevelFlag() === $this) {
                $content->setLevelFlag(null);
            }
        }

        return $this;
    }

}
