<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DestinationRepository::class)
 */
class Destination
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
    private $NomDes;

    /**
     * @Assert\Length(min = 3 , max = 255)
     *  @Assert\NotBlank
     * @ORM\Column(type="text", nullable=true)
     */
    private $inforDes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Population;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SitesTouristiques;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $transport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $meteo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $HeureLocale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SiteWeb;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Superficie;


    public function getId(): ?int
    {
        return $this->id;
    }





    public function getNomDes(): ?string
    {
        return $this->NomDes;
    }

    public function getSlug(): string{

        return (new Slugify())->slugify($this->getNomDes());
    }

    public function setNomDes(string $NomDes): self
    {
        $this->NomDes = $NomDes;

        return $this;
    }

    public function getInforDes(): ?string
    {
        return $this->inforDes;
    }

    public function setInforDes(?string $inforDes): self
    {
        $this->inforDes = $inforDes;

        return $this;
    }

    public function getPopulation(): ?int
    {
        return $this->Population;
    }

    public function setPopulation(?int $Population): self
    {
        $this->Population = $Population;

        return $this;
    }

    public function getSitesTouristiques(): ?string
    {
        return $this->SitesTouristiques;
    }

    public function setSitesTouristiques(?string $SitesTouristiques): self
    {
        $this->SitesTouristiques = $SitesTouristiques;

        return $this;
    }

    public function getTransport(): ?string
    {
        return $this->transport;
    }

    public function setTransport(?string $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function getMeteo(): ?string
    {
        return $this->meteo;
    }

    public function setMeteo(?string $meteo): self
    {
        $this->meteo = $meteo;

        return $this;
    }

    public function getHeureLocale(): ?string
    {
        return $this->HeureLocale;
    }

    public function setHeureLocale(?string $HeureLocale): self
    {
        $this->HeureLocale = $HeureLocale;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->SiteWeb;
    }

    public function setSiteWeb(?string $SiteWeb): self
    {
        $this->SiteWeb = $SiteWeb;

        return $this;
    }

    public function getSuperficie(): ?string
    {
        return $this->Superficie;
    }

    public function setSuperficie(?string $Superficie): self
    {
        $this->Superficie = $Superficie;

        return $this;
    }
}
