<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
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

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nickname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $profilepicture;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isAccepted;

    #[ORM\ManyToMany(targetEntity: Course::class, mappedBy: 'isCompletedBy')]
    private $HasEndedCourse;

    #[ORM\OneToMany(mappedBy: 'IsCreatedBy', targetEntity: Course::class, orphanRemoval: true)]
    private $hasCreatedCourse;

    public function __construct()
    {
        $this->HasEndedCourse = new ArrayCollection();
        $this->hasCreatedCourse = new ArrayCollection();
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

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getProfilepicture(): ?string
    {
        return $this->profilepicture;
    }

    public function setProfilepicture(?string $profilepicture): self
    {
        $this->profilepicture = $profilepicture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsAccepted(): ?bool
    {
        return $this->isAccepted;
    }

    public function setIsAccepted(?bool $isAccepted): self
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getHasEndedCourse(): Collection
    {
        return $this->HasEndedCourse;
    }

    public function addHasEndedCourse(Course $hasEndedCourse): self
    {
        if (!$this->HasEndedCourse->contains($hasEndedCourse)) {
            $this->HasEndedCourse[] = $hasEndedCourse;
            $hasEndedCourse->addIsCompletedBy($this);
        }

        return $this;
    }

    public function removeHasEndedCourse(Course $hasEndedCourse): self
    {
        if ($this->HasEndedCourse->removeElement($hasEndedCourse)) {
            $hasEndedCourse->removeIsCompletedBy($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getHasCreatedCourse(): Collection
    {
        return $this->hasCreatedCourse;
    }

    public function addHasCreatedCourse(Course $hasCreatedCourse): self
    {
        if (!$this->hasCreatedCourse->contains($hasCreatedCourse)) {
            $this->hasCreatedCourse[] = $hasCreatedCourse;
            $hasCreatedCourse->setIsCreatedBy($this);
        }

        return $this;
    }

    public function removeHasCreatedCourse(Course $hasCreatedCourse): self
    {
        if ($this->hasCreatedCourse->removeElement($hasCreatedCourse)) {
            // set the owning side to null (unless already changed)
            if ($hasCreatedCourse->getIsCreatedBy() === $this) {
                $hasCreatedCourse->setIsCreatedBy(null);
            }
        }

        return $this;
    }
}
