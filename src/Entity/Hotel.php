<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 * @Vich\Uploadable
 */
class Hotel
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("Hotel")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Hotel")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Hotel")
     */
    private $starsNumber;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="your message")
     * @Groups("Hotel")
     **/
    private $description;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Hotel")
     */
    private $localisation;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Hotel")
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    /**
     * @Vich\UploadableField(mapping="uploads", fileNameProperty="image")
     */
    private $imageHotel;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="hotel")
     */
    private $comments;


    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, mappedBy="hotel_reservation", cascade={"persist", "remove"})
     */
    private $reservation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Hotel")
     */
    private $adresse;

    /**
     * @return mixed
     */
    public function getAvailableRooms()
    {
        return $this->availableRooms;
    }

    /**
     * @param mixed $availableRooms
     */
    public function setAvailableRooms($availableRooms): void
    {
        $this->availableRooms = $availableRooms;
    }


    /**
     * @ORM\Column(type="integer")
     * @Groups("Hotel")
     */
    private $availableRooms;

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
    }


    public function __construct()
    {
        $this->updatedAt = new \DateTime();
        $this->comments = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStarsNumber()
    {
        return $this->starsNumber;
    }

    /**
     * @param mixed $starsNumber
     */
    public function setStarsNumber($starsNumber): void
    {
        $this->starsNumber = $starsNumber;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }



    /**
     * @return mixed
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * @param mixed $localisation
     */
    public function setLocalisation($localisation): void
    {
        $this->localisation = $localisation;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImageHotel()
    {
        return $this->imageHotel;
    }

    /**
     * @param mixed $imageHotel
     */
    public function setImageHotel($imageHotel): void
    {
        $this->imageHotel = $imageHotel;

        if ($imageHotel) {
          $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setHotelComments($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getHotelComments() === $this) {
                $comment->setHotelComments(null);
            }
        }

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        // set the owning side of the relation if necessary
        if ($reservation->getHotelReservation() !== $this) {
            $reservation->setHotelReservation($this);
        }

        $this->reservation = $reservation;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }



}
