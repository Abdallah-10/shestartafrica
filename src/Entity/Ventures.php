<?php

namespace App\Entity;

use App\Repository\VenturesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;


use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=VenturesRepository::class)
 * @vich\Uploadable
 */
class Ventures
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
     * @ORM\Column(type="date")
     */
    private $years;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sector;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover;

    /**
     * @Vich\UploadableField(mapping="ventures")
     * @var File
     */
    
    private $coverFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $flag;

    /**
     * @Vich\UploadableField(mapping="ventures")
     * @var File
     */
    
     private $flagFile;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkedIn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="venture")
     */
    private $teams;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="ventures", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Available::class, mappedBy="persona")
     */
    private $availables;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $founder;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->availables = new ArrayCollection();
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



    public function getYears(): ?\DateTimeInterface
    {
        return $this->years;
    }

    public function setYears(\DateTimeInterface $years): self
    {
        $this->years = $years;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(string $sector): self
    {
        $this->sector = $sector;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function getCoverFile(): ?File
    {
        return $this->coverFile;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }
    public function getFlagFile(): ?File
    {
        return $this->flagFile;
    }
    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

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

    public function getLinkedIn(): ?string
    {
        return $this->linkedIn;
    }

    public function setLinkedIn(?string $linkedIn): self
    {
        $this->linkedIn = $linkedIn;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }
    /**
     * @param File|null $coverFile
     */
    public function setCoverFile(?File $coverFile = null): self
    {
        $this->coverFile = $coverFile;
        
        return $this;
    }

    /**
     * @param File|null $flagFile
     */
    public function setflagFile(?File $flagFile = null): self
    {
        $this->flagFile = $flagFile;
        
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setVenture($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getVenture() === $this) {
                $team->setVenture(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Available>
     */
    public function getAvailables(): Collection
    {
        return $this->availables;
    }

    public function addAvailable(Available $available): self
    {
        if (!$this->availables->contains($available)) {
            $this->availables[] = $available;
            $available->setPersona($this);
        }

        return $this;
    }

    public function removeAvailable(Available $available): self
    {
        if ($this->availables->removeElement($available)) {
            // set the owning side to null (unless already changed)
            if ($available->getPersona() === $this) {
                $available->setPersona(null);
            }
        }

        return $this;
    }

    public function getFounder(): ?int
    {
        return $this->founder;
    }

    public function setFounder(?int $founder): self
    {
        $this->founder = $founder;

        return $this;
    }
}
