<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContentRepository::class)]
class Content
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\ManyToOne(targetEntity: LevelFlag::class, inversedBy: 'contents')]
    #[ORM\JoinColumn(nullable: true)]
    private $levelFlag;

    #[ORM\ManyToOne(targetEntity: ContentType::class, inversedBy: 'contents')]
    #[ORM\JoinColumn(nullable: false)]
    private $contentType;

    public function __toString(): string
    {
        return $this->getUrl();
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

    public function setLevelFlag(?LevelFlag $levelFlag): self
    {
        $this->levelFlag = $levelFlag;

        return $this;
    }

    public function getContentType(): ?ContentType
    {
        return $this->contentType;
    }

    public function setContentType(?ContentType $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }
}
