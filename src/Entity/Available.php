<?php

namespace App\Entity;

use App\Repository\AvailableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvailableRepository::class)
 */
class Available
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="availables")
     */
    private $User;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAdd;

    /**
     * @ORM\ManyToOne(targetEntity=Ventures::class, inversedBy="availables")
     */
    private $persona;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->dateAdd;
    }

    public function setDateAdd(?\DateTimeInterface $dateAdd): self
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    public function getPersona(): ?Ventures
    {
        return $this->persona;
    }

    public function setPersona(?Ventures $persona): self
    {
        $this->persona = $persona;

        return $this;
    }
}
