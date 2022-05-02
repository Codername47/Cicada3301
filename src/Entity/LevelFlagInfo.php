<?php

namespace App\Entity;

use App\Repository\LevelFlagInfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelFlagInfoRepository::class)]
class LevelFlagInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: jsContent::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $jsContent;

    #[ORM\OneToMany(mappedBy: 'levelFlagInfo', targetEntity: Content::class, orphanRemoval: true)]
    private $contents;

    public function __construct()
    {
        $this->contents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
    public function getContents(): Collection
    {
        return $this->contents;
    }

    public function addContent(Content $content): self
    {
        if (!$this->contents->contains($content)) {
            $this->contents[] = $content;
            $content->setLevelFlagInfo($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->contents->removeElement($content)) {
            // set the owning side to null (unless already changed)
            if ($content->getLevelFlagInfo() === $this) {
                $content->setLevelFlagInfo(null);
            }
        }

        return $this;
    }
}
