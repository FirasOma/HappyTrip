<?php

namespace App\Entity;

use App\Repository\VoyageVirtuelleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VoyageVirtuelleRepository::class)
 */
class VoyageVirtuelle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(min = 3 , max = 30)
     *   @Assert\Regex("/^[a-z]+/" , message="le nom de la ville ne peut pas contenir des chiffre ")
     * @ORM\Column(type="string", length=255)
     */
    private $NomVille;

    /**
     * @Assert\Length(min = 15 , max = 255)
     * @ORM\Column(type="text")
     */
    private $lienVideo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVille(): ?string
    {
        return $this->NomVille;
    }

    public function setNomVille(string $NomVille): self
    {
        $this->NomVille = $NomVille;

        return $this;
    }

    public function getLienVideo(): ?string
    {
        return $this->lienVideo;
    }

    public function setLienVideo(string $lienVideo): self
    {
        $this->lienVideo = $lienVideo;

        return $this;
    }
}
