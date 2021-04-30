<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="firstName is required")
     * @Assert\Length(
     *     min=3,
     *     max=100,
     *     minMessage="firstName needs to have at least 3 characters"
     * )
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="lastName is required")
     * @Assert\Length(
     *     min=3,
     *     max=100,
     *     minMessage="lastName needs to have at least 3 characters"
     * )
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="email is required")
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private string $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTime $updatedAt = null;

    /**
     * @ORM\ManyToOne(targetEntity="UserAddress",cascade="persist")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address; // UserAddress ?

    /**
     * @ORM\ManyToMany(targetEntity="UserContactPhone",cascade="persist")
     * @ORM\JoinTable(
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="phonenumber_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $phonenumbers; // ArrayCollection?


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->phonenumbers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->updatedAt = new \DateTime();
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->updatedAt = new \DateTime();
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->updatedAt = new \DateTime();
        $this->email = $email;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address): void
    {
        $this->updatedAt = new \DateTime();
        $this->address = $address;
    }

    public function getPhonenumbers()
    {
        return $this->phonenumbers;
    }

    public function setPhonenumbers($phonenumbers): void
    {
        $this->updatedAt = new \DateTime();
        $this->phonenumbers = $phonenumbers;
    }
}
