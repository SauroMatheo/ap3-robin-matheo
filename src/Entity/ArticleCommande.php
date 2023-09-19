<?php

namespace App\Entity;

use App\Repository\ArticleCommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleCommandeRepository::class)]
class ArticleCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'articleCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?articles $fk_articles = null;

    #[ORM\ManyToOne(inversedBy: 'articleCommandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?commandes $fk_commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getFkArticles(): ?articles
    {
        return $this->fk_articles;
    }

    public function setFkArticles(?articles $fk_articles): static
    {
        $this->fk_articles = $fk_articles;

        return $this;
    }

    public function getFkCommande(): ?commandes
    {
        return $this->fk_commande;
    }

    public function setFkCommande(?commandes $fk_commande): static
    {
        $this->fk_commande = $fk_commande;

        return $this;
    }
}
