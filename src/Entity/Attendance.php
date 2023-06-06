<?php

namespace App\Entity;

use App\Repository\AttendanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttendanceRepository::class)
 */
class Attendance
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userlastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $useremail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $date = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $attendancy = [];

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Training::class, inversedBy="attendances")
     */
    private $training;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserlastname(): ?string
    {
        return $this->userlastname;
    }

    public function setUserlastname(string $userlastname): self
    {
        $this->userlastname = $userlastname;

        return $this;
    }

    public function getUseremail(): ?string
    {
        return $this->useremail;
    }

    public function setUseremail(string $useremail): self
    {
        $this->useremail = $useremail;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getDate(): ?array
    {
        return $this->date;
    }

    public function setDate(?array $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAttendancy(): ?array
    {
        return $this->attendancy;
    }

    public function setAttendancy(?array $attendancy): self
    {
        $this->attendancy = $attendancy;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        $this->training = $training;

        return $this;
    }
}
