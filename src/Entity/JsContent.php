<?php

namespace App\Entity;

use App\Repository\JsContentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: JsContentRepository::class)]
class JsContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $url = "//change_url";

    #[ORM\OneToOne(mappedBy: 'jsContent', targetEntity: LevelFlag::class, cascade: ["persist"])]
    private $levelFlag;

    #[Assert\PositiveOrZero]
    #[ORM\Column(type: 'integer')]
    private $timeout = 0;



    public function __toString(): string
    {
        return $this->url;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLevelFlag(): ?LevelFlag
    {
        return $this->levelFlag;
    }

    public function setLevelFlag(LevelFlag $levelFlag): self
    {
        // set the owning side of the relation if necessary
        if ($levelFlag->getJsContent() !== $this) {
            $levelFlag->setJsContent($this);
        }

        $this->levelFlag = $levelFlag;

        return $this;
    }

    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }
}
