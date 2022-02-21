<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reclamations")
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $stars_number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function getStarsNumber(): ?int
    {
        return $this->stars_number;
    }

    public function setStarsNumber(int $stars_number): self
    {
        $this->stars_number = $stars_number;

        return $this;
    }
}
