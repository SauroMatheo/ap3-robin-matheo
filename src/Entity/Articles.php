<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\OneToMany(mappedBy: 'fk_articles', targetEntity: Stockage::class, orphanRemoval: true)]
    private Collection $stockages;

    #[ORM\OneToMany(mappedBy: 'fk_articles', targetEntity: ArticleCommande::class)]
    private Collection $articleCommandes;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?rayons $fk_rayons = null;

    #[ORM\ManyToMany(targetEntity: Sport::class, mappedBy: 'lesarticles')]
    private Collection $lessports;

    public function __construct()
    {
        $this->stockages = new ArrayCollection();
        $this->articleCommandes = new ArrayCollection();
        $this->lessports = new ArrayCollection();
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

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
            $stockage->setFkArticles($this);
        }

        return $this;
    }

    public function removeStockage(Stockage $stockage): static
    {
        if ($this->stockages->removeElement($stockage)) {
            // set the owning side to null (unless already changed)
            if ($stockage->getFkArticles() === $this) {
                $stockage->setFkArticles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArticleCommande>
     */
    public function getArticleCommandes(): Collection
    {
        return $this->articleCommandes;
    }

    public function addArticleCommande(ArticleCommande $articleCommande): static
    {
        if (!$this->articleCommandes->contains($articleCommande)) {
            $this->articleCommandes->add($articleCommande);
            $articleCommande->setFkArticles($this);
        }

        return $this;
    }

    public function removeArticleCommande(ArticleCommande $articleCommande): static
    {
        if ($this->articleCommandes->removeElement($articleCommande)) {
            // set the owning side to null (unless already changed)
            if ($articleCommande->getFkArticles() === $this) {
                $articleCommande->setFkArticles(null);
            }
        }

        return $this;
    }

    public function getFkRayons(): ?rayons
    {
        return $this->fk_rayons;
    }

    public function setFkRayons(?rayons $fk_rayons): static
    {
        $this->fk_rayons = $fk_rayons;

        return $this;
    }

    /**
     * @return Collection<int, Sport>
     */
    public function getLessports(): Collection
    {
        return $this->lessports;
    }

    public function addLessport(Sport $lessport): static
    {
        if (!$this->lessports->contains($lessport)) {
            $this->lessports->add($lessport);
            $lessport->addLesarticle($this);
        }

        return $this;
    }

    public function removeLessport(Sport $lessport): static
    {
        if ($this->lessports->removeElement($lessport)) {
            $lessport->removeLesarticle($this);
        }

        return $this;
    }
}
