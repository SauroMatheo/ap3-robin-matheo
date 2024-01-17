<?php

namespace App\Entity;

use App\Repository\StockageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/*
Classe Stockage: (Déprécié)
Abstraction d'une quantité d'un article dans un magasin. A revoir durant l'implémentation du LotB

?int quantite:          Quantité d'un article
?Articles fk_articles:  Article concerné
?Magasins fk_magasins:  Magasin concerné
*/
#[ORM\Entity(repositoryClass: StockageRepository::class)]
class Stockage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'stockages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Articles $fk_articles = null;

    #[ORM\ManyToOne(inversedBy: 'stockages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Magasins $fk_magasins = null;

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

    public function getFkArticles(): ?Articles
    {
        return $this->fk_articles;
    }

    public function setFkArticles(?Articles $fk_articles): static
    {
        $this->fk_articles = $fk_articles;

        return $this;
    }

    public function getFkMagasins(): ?Magasins
    {
        return $this->fk_magasins;
    }

    public function setFkMagasins(?Magasins $fk_magasins): static
    {
        $this->fk_magasins = $fk_magasins;

        return $this;
    }
}
