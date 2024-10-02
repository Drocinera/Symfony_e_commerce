<?php

namespace App\Entity;

use App\Repository\SweatshirtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: Types::ARRAY)]
    private array $size = [];

    /**
     * @var Collection<int, SweatshirtSize>
     */
    #[ORM\OneToMany(targetEntity: SweatshirtSize::class, mappedBy: 'Sweatshirt_relation')]
    private Collection $sweatshirtSizes;

    #[ORM\Column]
    private ?bool $Highlight = null;

    public function __construct()
    {
        $this->sweatshirtSizes = new ArrayCollection();
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

    public function getSize(): array
    {
        return $this->size;
    }

    public function setSize(array $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return Collection<int, SweatshirtSize>
     */
    public function getSweatshirtSizes(): Collection
    {
        return $this->sweatshirtSizes;
    }

    public function addSweatshirtSize(SweatshirtSize $sweatshirtSize): static
    {
        if (!$this->sweatshirtSizes->contains($sweatshirtSize)) {
            $this->sweatshirtSizes->add($sweatshirtSize);
            $sweatshirtSize->setSweatshirtRelation($this);
        }

        return $this;
    }

    public function removeSweatshirtSize(SweatshirtSize $sweatshirtSize): static
    {
        if ($this->sweatshirtSizes->removeElement($sweatshirtSize)) {
            // set the owning side to null (unless already changed)
            if ($sweatshirtSize->getSweatshirtRelation() === $this) {
                $sweatshirtSize->setSweatshirtRelation(null);
            }
        }

        return $this;
    }

    public function isHighlight(): ?bool
    {
        return $this->Highlight;
    }

    public function setHighlight(bool $Highlight): static
    {
        $this->Highlight = $Highlight;

        return $this;
    }
}
