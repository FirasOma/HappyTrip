<?php

namespace App\Entity;

use App\Repository\ReservationRestaurantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRestaurantRepository::class)
 */
class ReservationRestaurant
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreplace;

    /**
     * @ORM\Column(type="datetime")
     */
    private $reservationdate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getNombreplace(): ?int
    {
        return $this->nombreplace;
    }

    public function setNombreplace(int $nombreplace): self
    {
        $this->nombreplace = $nombreplace;

        return $this;
    }

    public function getReservationdate(): ?\DateTimeInterface
    {
        return $this->reservationdate;
    }

    public function setReservationdate(\DateTimeInterface $reservationdate): self
    {
        $this->reservationdate = $reservationdate;

        return $this;
    }
}
