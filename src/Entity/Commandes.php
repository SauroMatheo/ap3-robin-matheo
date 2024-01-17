<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/*
Classe Commandes:
Commandes de l'utilisateur, d'un ou plusieurs articles

?\DateTimeInterface date_commande:      Date de création de la commande
?\DateTimeInterface date_reception:     Date de réception de la commande
Collection articleCommandes:            Ensemble des lots d'articles
?Utilisateurs fk_utilisateurs:          Utilisateur ayant créé la commande
?Etats fk_etat:                         Etat de la commande (parmis les états possibles)
*/
#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_commande = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_reception = null;

    #[ORM\OneToMany(mappedBy: 'fk_commande', targetEntity: ArticleCommande::class)]
    private Collection $articleCommandes;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Utilisateurs $fk_utilisateurs = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etats $fk_etat = null;

    public function __construct()
    {
        $this->articleCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): static
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->date_reception;
    }

    public function setDateReception(\DateTimeInterface $date_reception): static
    {
        $this->date_reception = $date_reception;

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
            $articleCommande->setFkCommande($this);
        }

        return $this;
    }

    public function removeArticleCommande(ArticleCommande $articleCommande): static
    {
        if ($this->articleCommandes->removeElement($articleCommande)) {
            // set the owning side to null (unless already changed)
            if ($articleCommande->getFkCommande() === $this) {
                $articleCommande->setFkCommande(null);
            }
        }

        return $this;
    }

    public function getFkUtilisateurs(): ?Utilisateurs
    {
        return $this->fk_utilisateurs;
    }

    public function setFkUtilisateurs(?Utilisateurs $fk_utilisateurs): static
    {
        $this->fk_utilisateurs = $fk_utilisateurs;

        return $this;
    }

    public function getFkEtat(): ?Etats
    {
        return $this->fk_etat;
    }

    public function setFkEtat(?Etats $fk_etat): static
    {
        $this->fk_etat = $fk_etat;

        return $this;
    }
}
