<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 */
class Animal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $admission_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $year_of_birth;

    /**
     * @ORM\Column(type="float")
     */
    private $weigth;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="float")
     */
    private $length;

    /**
     * @ORM\ManyToOne(targetEntity=Color::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=Breed::class, inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $breed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdmissionDate(): ?\DateTimeInterface
    {
        return $this->admission_date;
    }

    public function setAdmissionDate(\DateTimeInterface $admission_date): self
    {
        $this->admission_date = $admission_date;

        return $this;
    }

    public function getYearOfBirth(): ?int
    {
        return $this->year_of_birth;
    }

    public function setYearOfBirth(int $year_of_birth): self
    {
        $this->year_of_birth = $year_of_birth;

        return $this;
    }

    public function getWeigth(): ?float
    {
        return $this->weigth;
    }

    public function setWeigth(float $weigth): self
    {
        $this->weigth = $weigth;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->breed = $breed;

        return $this;
    }
}
