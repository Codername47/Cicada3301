<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
#[UniqueEntity(fields: ['email'], message: "There is already an account with this email")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 32, unique: true)]
    private $username;

    #[ORM\OneToOne(targetEntity: UserInfo::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $userInfo;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: AchievedLevel::class, orphanRemoval: true)]
    private $achievedLevels;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: AchievedFlag::class, orphanRemoval: true)]
    private $achievedFlags;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function __construct()
    {
        $this->achievedLevels = new ArrayCollection();
        $this->achievedFlags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUserInfoId(): ?UserInfo
    {
        return $this->userInfo;
    }

    public function setUserInfoId(UserInfo $userInfo): self
    {
        $this->userInfo = $userInfo;

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
            $achievedLevel->setUser($this);
        }

        return $this;
    }

    public function removeAchievedLevel(AchievedLevel $achievedLevel): self
    {
        if ($this->achievedLevels->removeElement($achievedLevel)) {
            // set the owning side to null (unless already changed)
            if ($achievedLevel->getUser() === $this) {
                $achievedLevel->setUser(null);
            }
        }

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
            $achievedFlag->setUser($this);
        }

        return $this;
    }

    public function removeAchievedFlag(AchievedFlag $achievedFlag): self
    {
        if ($this->achievedFlags->removeElement($achievedFlag)) {
            // set the owning side to null (unless already changed)
            if ($achievedFlag->getUser() === $this) {
                $achievedFlag->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
