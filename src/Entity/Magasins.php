<?php

namespace App\Entity;

use App\Repository\MagasinsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MagasinsRepository::class)]
class Magasins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\OneToMany(mappedBy: 'fk_magasins', targetEntity: Stockage::class, orphanRemoval: true)]
    private Collection $stockages;

    public function __construct()
    {
        $this->stockages = new ArrayCollection();
    }

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Stockage>
     */
    public function getStockages(): Collection
    {
        return $this->stockages;
    }

    public function addStockage(Stockage $stockage): static
    {
        if (!$this->stockages->contains($stockage)) {
            $this->stockages->add($stockage);
            $stockage->setFkMagasins($this);
        }

        return $this;
    }

    public function removeStockage(Stockage $stockage): static
    {
        if ($this->stockages->removeElement($stockage)) {
            // set the owning side to null (unless already changed)
            if ($stockage->getFkMagasins() === $this) {
                $stockage->setFkMagasins(null);
            }
        }

        return $this;
    }
}
