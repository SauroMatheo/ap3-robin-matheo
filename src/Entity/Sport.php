<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportRepository::class)]
class Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Utilisateurs::class, inversedBy: 'sports')]
    private Collection $utilisateurs;

    #[ORM\ManyToMany(targetEntity: Articles::class, inversedBy: 'lessports')]
    private Collection $lesarticles;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->lesarticles = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateurs>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateurs $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateurs $utilisateur): static
    {
        $this->utilisateurs->removeElement($utilisateur);

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getLesarticles(): Collection
    {
        return $this->lesarticles;
    }

    public function addLesarticle(Articles $lesarticle): static
    {
        if (!$this->lesarticles->contains($lesarticle)) {
            $this->lesarticles->add($lesarticle);
        }

        return $this;
    }

    public function removeLesarticle(Articles $lesarticle): static
    {
        $this->lesarticles->removeElement($lesarticle);

        return $this;
    }
}
