<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=TrainingRepository::class)
 * @vich\Uploadable
 */
class Training
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="date")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $session;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $course;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover;

    /**
     * @Vich\UploadableField(mapping="Training")
     * @var File
     */
    
     private $coverFile;

     /**
      * @ORM\Column(type="string", length=255)
      */
     private $slug;

     /**
      * @ORM\ManyToOne(targetEntity=Expert::class, inversedBy="trainings")
      */
     private $trainer;

     /**
      * @ORM\OneToMany(targetEntity=Inscreption::class, mappedBy="training")
      */
     private $inscreptions;

     /**
      * @ORM\OneToMany(targetEntity=Attendance::class, mappedBy="training")
      */
     private $attendances;

     public function __construct()
     {
         $this->inscreptions = new ArrayCollection();
         $this->attendances = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getSession(): ?int
    {
        return $this->session;
    }

    public function setSession(?int $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(?string $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getCoverFile(): ?File
    {
        return $this->coverFile;
    }

     /**
     * @param File|null $coverFile
     */
    public function setCoverFile(?File $coverFile = null): self
    {
        $this->coverFile = $coverFile;
        
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

    public function getTrainer(): ?Expert
    {
        return $this->trainer;
    }

    public function setTrainer(?Expert $trainer): self
    {
        $this->trainer = $trainer;

        return $this;
    }

    /**
     * @return Collection<int, Inscreption>
     */
    public function getInscreptions(): Collection
    {
        return $this->inscreptions;
    }

    public function addInscreption(Inscreption $inscreption): self
    {
        if (!$this->inscreptions->contains($inscreption)) {
            $this->inscreptions[] = $inscreption;
            $inscreption->setTraining($this);
        }

        return $this;
    }

    public function removeInscreption(Inscreption $inscreption): self
    {
        if ($this->inscreptions->removeElement($inscreption)) {
            // set the owning side to null (unless already changed)
            if ($inscreption->getTraining() === $this) {
                $inscreption->setTraining(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }

    /**
     * @return Collection<int, Attendance>
     */
    public function getAttendances(): Collection
    {
        return $this->attendances;
    }

    public function addAttendance(Attendance $attendance): self
    {
        if (!$this->attendances->contains($attendance)) {
            $this->attendances[] = $attendance;
            $attendance->setTraining($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendances->removeElement($attendance)) {
            // set the owning side to null (unless already changed)
            if ($attendance->getTraining() === $this) {
                $attendance->setTraining(null);
            }
        }

        return $this;
    }
}
