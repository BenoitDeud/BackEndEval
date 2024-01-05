<?php

namespace App\Entity;

use App\Repository\TelephonesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelephonesRepository::class)]
class Telephones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageTel = null;

    #[ORM\Column]
    private ?int $quantiteTelephone = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

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

    public function getImageTel(): ?string
    {
        return $this->imageTel;
    }

    public function setImageTel(?string $imageTel): static
    {
        $this->imageTel = $imageTel;

        return $this;
    }

    public function getQuantiteTelephone(): ?int
    {
        return $this->quantiteTelephone;
    }

    public function setQuantiteTelephone(int $quantiteTelephone): static
    {
        $this->quantiteTelephone = $quantiteTelephone;

        return $this;
    }

}
