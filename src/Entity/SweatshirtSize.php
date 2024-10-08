<?php

namespace App\Entity;

use App\Repository\SweatshirtSizeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SweatshirtSizeRepository::class)]
class SweatshirtSize
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $size = null;

    #[ORM\Column]
    private ?int $stock = null;

    // Relation ManyToOne avec Sweatshirt (nommé sweatshirt ici au lieu de Sweatshirt_relation)
    #[ORM\ManyToOne(inversedBy: 'sizes')]
    #[ORM\JoinColumn(nullable: false)]  // Cela permet de rendre la relation obligatoire
    private ?Sweatshirt $sweatshirt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getSweatshirt(): ?Sweatshirt
    {
        return $this->sweatshirt;
    }

    public function setSweatshirt(?Sweatshirt $sweatshirt): static
    {
        $this->sweatshirt = $sweatshirt;

        return $this;
    }
}
