<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'date')]
    private $creationDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Picture;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $slug;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'HasEndedCourse')]
    #[ORM\JoinColumn(nullable: true)] // A supprimer
    private $isCompletedBy;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'hasCreatedCourse')]
    #[ORM\JoinColumn(nullable: true)] // A remettre à false
    private $IsCreatedBy;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: Section::class, orphanRemoval: true)]
    private $Section;

    public function __construct()
    {
        $this->isCompletedBy = new ArrayCollection();
        $this->Section = new ArrayCollection();
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->Picture = $Picture;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIsCompletedBy(): Collection
    {
        return $this->isCompletedBy;
    }

    public function addIsCompletedBy(User $isCompletedBy): self
    {
        if (!$this->isCompletedBy->contains($isCompletedBy)) {
            $this->isCompletedBy[] = $isCompletedBy;
        }

        return $this;
    }

    public function removeIsCompletedBy(User $isCompletedBy): self
    {
        $this->isCompletedBy->removeElement($isCompletedBy);

        return $this;
    }

    public function getIsCreatedBy(): ?User
    {
        return $this->IsCreatedBy;
    }

    public function setIsCreatedBy(?User $IsCreatedBy): self
    {
        $this->IsCreatedBy = $IsCreatedBy;

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getSection(): Collection
    {
        return $this->Section;
    }

    public function addSection(Section $section): self
    {
        if (!$this->Section->contains($section)) {
            $this->Section[] = $section;
            $section->setCourse($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->Section->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getCourse() === $this) {
                $section->setCourse(null);
            }
        }

        return $this;
    }
}
