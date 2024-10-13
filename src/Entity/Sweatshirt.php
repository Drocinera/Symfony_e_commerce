<?php

namespace App\Entity;

use App\Repository\SweatshirtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SweatshirtRepository::class)]
class Sweatshirt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?bool $highlight = null; 

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    // Relation OneToMany avec SweatshirtSize 
    #[ORM\OneToMany(mappedBy: 'sweatshirt', targetEntity: SweatshirtSize::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $sizes;

    public function __construct()
    {
        $this->sizes = new ArrayCollection();
    }

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, SweatshirtSize>
     */
    public function getSizes(): Collection
    {
        return $this->sizes;
    }

    public function addSize(SweatshirtSize $size): static
    {
        if (!$this->sizes->contains($size)) {
            $this->sizes->add($size);
            $size->setSweatshirt($this);
        }

        return $this;
    }

    public function removeSize(SweatshirtSize $size): static
    {
        if ($this->sizes->removeElement($size)) {
            // Si la taille appartient encore à ce sweatshirt, on la dissocie
            if ($size->getSweatshirt() === $this) {
                $size->setSweatshirt(null);
            }
        }

        return $this;
    }

    public function isHighlight(): ?bool
    {
        return $this->highlight;
    }

    public function setHighlight(bool $highlight): static
    {
        $this->highlight = $highlight;

        return $this;
    }

    public function getHighlight(): bool
    {
        return $this->highlight;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
