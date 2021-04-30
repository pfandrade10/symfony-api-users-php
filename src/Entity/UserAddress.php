<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_address")
 */
class UserAddress
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $state;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $city;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $district;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $street;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $number;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $complement;

    public function __construct()
    {
        
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }
    
    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function setDistrict(string $district): void
    {
        $this->district = $district;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getComplement(): string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): void
    {
        $this->complement = $complement;
    }
}
