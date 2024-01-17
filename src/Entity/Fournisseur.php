<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/*
Classe Fournisseur:

?string nom:            Nom du fournisseur
Collection lesArticles: Ensemble des articles fournis par le fournisseur
*/
#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'leFournisseur', targetEntity: Articles::class)]
    private Collection $lesArticles;

    public function __construct()
    {
        $this->lesArticles = new ArrayCollection();
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

    /**
     * @return Collection<int, Articles>
     */
    public function getLesArticles(): Collection
    {
        return $this->lesArticles;
    }

    public function addLesArticle(Articles $lesArticle): static
    {
        if (!$this->lesArticles->contains($lesArticle)) {
            $this->lesArticles->add($lesArticle);
            $lesArticle->setLeFournisseur($this);
        }

        return $this;
    }

    public function removeLesArticle(Articles $lesArticle): static
    {
        if ($this->lesArticles->removeElement($lesArticle)) {
            // set the owning side to null (unless already changed)
            if ($lesArticle->getLeFournisseur() === $this) {
                $lesArticle->setLeFournisseur(null);
            }
        }

        return $this;
    }
}
