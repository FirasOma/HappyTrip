<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 * @Vich\Uploadable
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("Event")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=36)
     * @Assert\NotBlank(message="your message")
     * @Groups("Event")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="your message")
     * @Groups("Event")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Event")
     */
    private $image;
    /**
     * @Vich\UploadableField (mapping="uploads",fileNameProperty="image")
     */
    private $imageEvent;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("Event")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("Event")
     */
    private $datEvent;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("Event")
     */
    private $cancel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="your message")
     * @Groups("Event")
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="your message")
     * @Groups("Event")
     */
    private $phone;



   public function __construct()
   {
       $this->createdAt =new \DateTime();
   }



    /**
     * @return mixed
     */
    public function getId(): ?int
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param  mixed $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * @param  mixed $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage(): ?string
    {
        return $this->image;
    }
    /**
     * @param  mixed $image
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    /**
     * @param  mixed $createdAt
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getDatEvent(): ?\DateTimeInterface
    {
        return $this->datEvent;
    }
    /**
     * @param  mixed $datEvent
     */
    public function setDatEvent(\DateTimeInterface $datEvent): self
    {
        $this->datEvent = $datEvent;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getCancel(): ?bool
    {
        return $this->cancel;
    }
    /**
     * @param  mixed $cancel
     */
    public function setCancel(bool $cancel): self
    {
        $this->cancel = $cancel;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageEvent()
    {
        return $this->imageEvent;
    }

    /**
     * @param mixed $imageEvent
     */
    public function setImageEvent($imageEvent):void
    {
        $this->imageEvent=$imageEvent;
        if($imageEvent){
            $this->createdAt =new \DateTime();
        }
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
