<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 * @Vich\Uploadable
 */
class Offer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("Offre")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=36)
     * @Assert\NotBlank(message="your message")
     * @Groups("Offre")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="your message")
     * @Groups("Offre")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Offre")
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("Offre")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("Offre")
     */
    private $dateBegin;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("Offre")
     */
    private $DateEnd;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("Offre")
     */
    private $cancel;

    /**
     * @Vich\UploadableField (mapping="uploads",fileNameProperty="image")
     */
    private $imgOff;


    /**
     * @return mixed
     */
    public function getImgOff()
    {
        return $this->imgOff;
    }

    /**
     * @param mixed $imgOff
     *
     */
    public function setImageEvent($imgOff):void
    {
        $this->imgOff=$imgOff;
        if($imgOff){
            $this->createdAt =new \DateTime();
        }
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDateBegin(): ?\DateTimeInterface
    {
        return $this->dateBegin;
    }

    public function setDateBegin(\DateTimeInterface $dateBegin): self
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->DateEnd;
    }

    public function setDateEnd(\DateTimeInterface $DateEnd): self
    {
        $this->DateEnd = $DateEnd;

        return $this;
    }

    public function getCancel(): ?bool
    {
        return $this->cancel;
    }

    public function setCancel(bool $cancel): self
    {
        $this->cancel = $cancel;

        return $this;
    }
}
