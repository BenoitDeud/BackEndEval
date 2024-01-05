<?php

namespace App\Entity;

use App\Repository\MontresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MontresRepository::class)]
class Montres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageMontre = null;

    #[ORM\Column]
    private ?int $quantiteMontre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageMontre(): ?string
    {
        return $this->imageMontre;
    }

    public function setImageMontre(?string $imageMontre): static
    {
        $this->imageMontre = $imageMontre;

        return $this;
    }

    public function getQuantiteMontre(): ?int
    {
        return $this->quantiteMontre;
    }

    public function setQuantiteMontre(int $quantiteMontre): static
    {
        $this->quantiteMontre = $quantiteMontre;

        return $this;
    }
}
