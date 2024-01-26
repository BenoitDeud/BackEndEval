<?php

namespace App\Entity;

use App\Repository\LogoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogoRepository::class)]
class Logo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoStore = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogoStore(): ?string
    {
        return $this->logoStore;
    }

    public function setLogoStore(?string $logoStore): static
    {
        $this->logoStore = $logoStore;

        return $this;
    }
}
