<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $firstname;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ["ROLE_USER"];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToOne(targetEntity=Ventures::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $ventures;

    /**
     * @ORM\OneToOne(targetEntity=Mentor::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $mentor;

    /**
     * @ORM\OneToOne(targetEntity=Expert::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $expert;

    /**
     * @ORM\OneToMany(targetEntity=Inscreption::class, mappedBy="user", cascade={"remove"})
     */
    private $inscreptions;

    /**
     * @ORM\OneToMany(targetEntity=Available::class, mappedBy="User")
     */
    private $availables;

    /**
     * @ORM\OneToOne(targetEntity=Investor::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $investor;

    public function __construct()
    {
        $this->inscreptions = new ArrayCollection();
        $this->availables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->firstname;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->firstname;
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(?string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): self
    {
        $this->biography = $biography;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getVentures(): ?Ventures
    {
        return $this->ventures;
    }

    public function setVentures(?Ventures $ventures): self
    {
        // unset the owning side of the relation if necessary
        if ($ventures === null && $this->ventures !== null) {
            $this->ventures->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($ventures !== null && $ventures->getUser() !== $this) {
            $ventures->setUser($this);
        }

        $this->ventures = $ventures;

        return $this;
    }

    public function getMentor(): ?Mentor
    {
        return $this->mentor;
    }

    public function setMentor(Mentor $mentor): self
    {
        // set the owning side of the relation if necessary
        if ($mentor->getUser() !== $this) {
            $mentor->setUser($this);
        }

        $this->mentor = $mentor;

        return $this;
    }

    public function getExpert(): ?Expert
    {
        return $this->expert;
    }

    public function setExpert(?Expert $expert): self
    {
        // unset the owning side of the relation if necessary
        if ($expert === null && $this->expert !== null) {
            $this->expert->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($expert !== null && $expert->getUser() !== $this) {
            $expert->setUser($this);
        }

        $this->expert = $expert;

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
            $inscreption->setUser($this);
        }

        return $this;
    }

    public function removeInscreption(Inscreption $inscreption): self
    {
        if ($this->inscreptions->removeElement($inscreption)) {
            // set the owning side to null (unless already changed)
            if ($inscreption->getUser() === $this) {
                $inscreption->setUser(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->firstname.' '.$this->lastname;
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
            $available->setUser($this);
        }

        return $this;
    }

    public function removeAvailable(Available $available): self
    {
        if ($this->availables->removeElement($available)) {
            // set the owning side to null (unless already changed)
            if ($available->getUser() === $this) {
                $available->setUser(null);
            }
        }

        return $this;
    }

    public function getInvestor(): ?Investor
    {
        return $this->investor;
    }

    public function setInvestor(?Investor $investor): self
    {
        // unset the owning side of the relation if necessary
        if ($investor === null && $this->investor !== null) {
            $this->investor->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($investor !== null && $investor->getUser() !== $this) {
            $investor->setUser($this);
        }

        $this->investor = $investor;

        return $this;
    }
}
