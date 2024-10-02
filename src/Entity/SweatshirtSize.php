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

    #[ORM\ManyToOne(inversedBy: 'sweatshirtSizes')]
    private ?Sweatshirt $Sweatshirt_relation = null;

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

    public function getSweatshirtRelation(): ?Sweatshirt
    {
        return $this->Sweatshirt_relation;
    }

    public function setSweatshirtRelation(?Sweatshirt $Sweatshirt_relation): static
    {
        $this->Sweatshirt_relation = $Sweatshirt_relation;

        return $this;
    }
}
