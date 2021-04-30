<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_contact_phone")
 */
class UserContactPhone
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 11,
     *      max = 99,
     *      notInRangeMessage = " must be between {{ min }} and {{max}}",
     * )
     */
    private int $areaCode;

    /**
     * @ORM\Column(type="string", length=9)
     * @Assert\NotBlank(message="Sufix is required")
     * @Assert\Regex(
     *     pattern     = "/^(\d{4})[-](\d{4})$"
     * )
     */
    private string $sufix;

    public function __construct()
    {
        
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAreaCode(): int
    {
        return $this->areaCode;
    }

    public function setAreaCode(int $areaCode): void
    {
        $this->areaCode = $areaCode;
    }

    public function getSufix(): string
    {
        return $this->sufix;
    }

    public function setSufix(string $sufix): void
    {
        $this->sufix = $sufix;
    }
}
