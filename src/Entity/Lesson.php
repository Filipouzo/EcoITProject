<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
class Lesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $content;

    #[ORM\ManyToOne(targetEntity: Section::class, inversedBy: 'lessons')]
    private $section;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'CheckedLessons')]
    private $isCheckedBy;

    public function __construct()
    {
        $this->isCheckedBy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIsCheckedBy(): Collection
    {
        return $this->isCheckedBy;
    }

    public function addIsCheckedBy(User $isCheckedBy): self
    {
        if (!$this->isCheckedBy->contains($isCheckedBy)) {
            $this->isCheckedBy[] = $isCheckedBy;
        }

        return $this;
    }

    public function removeIsCheckedBy(User $isCheckedBy): self
    {
        $this->isCheckedBy->removeElement($isCheckedBy);

        return $this;
    }
}
