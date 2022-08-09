<?php

namespace App\Entity;

use App\Repository\AchievedFlagRepository;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Validator as AcmeAssert;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
#[UniqueEntity(fields: ['email'], message: "There is already an account with this email")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 32, unique: true)]
    #[Assert\Length(
        min: 4,
        max: 32,
        minMessage: "Your username should be at list {{ limit }} characters",
        maxMessage: 'Your username should be less {{ limit }} characters',
    )]
    private $username;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private $email;


    #[ORM\Column(type: 'string')]
    #[Assert\Length(
        min: 6,
        max: 64,
        minMessage: 'Your password should be at least {{ limit }} characters',
        maxMessage: 'Your password should be less {{ limit }} characters',
    )]
    private $password;

    #[ORM\Column(type: 'json')]
    #[AcmeAssert\RoleConstraint]
    private $roles = [];


    #[ORM\OneToOne(inversedBy: 'user', targetEntity: UserInfo::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $userInfo;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: AchievedLevel::class, orphanRemoval: true)]
    private $achievedLevels;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: AchievedFlag::class, orphanRemoval: true)]
    private $achievedFlags;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[Assert\Length(
        min: 6,
        max: 64,
        minMessage: 'Your password should be at least {{ limit }} characters',
        maxMessage: 'Your password should be less {{ limit }} characters',
    )]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $plainPassword;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $lastOnline;




    public function __construct()
    {
        $this->achievedLevels = new ArrayCollection();
        $this->achievedFlags = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->username;
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
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        if ($roles instanceof ArrayCollection)
            $roles = $roles->toArray();
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
        $this->plainPassword = null;
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

    public function getUserInfo(): ?UserInfo
    {
        return $this->userInfo;
    }

    public function setUserInfo(UserInfo $userInfo): self
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

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getMaxLvl()
    {
        $MaxLvl = $this->achievedLevels->last();
        if($MaxLvl) $MaxLvl = $MaxLvl->getLevel()->getName();
        return ($MaxLvl != false)?strval($MaxLvl):"NOONE";
    }

    public function getLastFlag()
    {
        $lastFlag = $this->achievedFlags->matching(Criteria::create()->orderBy(['dateAchieve' => 'DESC']))->first();
        if ($lastFlag) $lastFlag=$lastFlag->getLevelFlag()->getName();
        return ($lastFlag != false)?strval($lastFlag):"NOONE";
    }

    public function getLastOnline(): ?\DateTimeInterface
    {
        return $this->lastOnline;
    }

    public function setLastOnline(?\DateTimeInterface $lastOnline): self
    {
        $this->lastOnline = $lastOnline;

        return $this;
    }



}
