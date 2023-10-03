<?php

namespace App\Entity;

use App\Repository\EnfantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnfantsRepository::class)]
class Enfants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\OneToMany(mappedBy: 'enfants', targetEntity: Utilisateurs::class)]
    private Collection $responsable_legal;

    public function __construct()
    {
        $this->responsable_legal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateurs>
     */
    public function getResponsableLegal(): Collection
    {
        return $this->responsable_legal;
    }

    public function addResponsableLegal(Utilisateurs $responsableLegal): static
    {
        if (!$this->responsable_legal->contains($responsableLegal)) {
            $this->responsable_legal->add($responsableLegal);
            $responsableLegal->setEnfants($this);
        }

        return $this;
    }

    public function removeResponsableLegal(Utilisateurs $responsableLegal): static
    {
        if ($this->responsable_legal->removeElement($responsableLegal)) {
            // set the owning side to null (unless already changed)
            if ($responsableLegal->getEnfants() === $this) {
                $responsableLegal->setEnfants(null);
            }
        }

        return $this;
    }
}
