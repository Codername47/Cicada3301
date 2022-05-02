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

    #[ORM\ManyToOne(targetEntity: LevelFlagInfo::class, inversedBy: 'contents')]
    #[ORM\JoinColumn(nullable: false)]
    private $levelFlagInfo;

    #[ORM\ManyToOne(targetEntity: ContentType::class, inversedBy: 'contents')]
    #[ORM\JoinColumn(nullable: false)]
    private $contentType;

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

    public function getLevelFlagInfo(): ?LevelFlagInfo
    {
        return $this->levelFlagInfo;
    }

    public function setLevelFlagInfo(?LevelFlagInfo $levelFlagInfo): self
    {
        $this->levelFlagInfo = $levelFlagInfo;

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
