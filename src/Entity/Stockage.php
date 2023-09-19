<?php

namespace App\Entity;

use App\Repository\StockageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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
    private ?articles $fk_articles = null;

    #[ORM\ManyToOne(inversedBy: 'stockages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?magasins $fk_magasins = null;

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

    public function getFkMagasins(): ?magasins
    {
        return $this->fk_magasins;
    }

    public function setFkMagasins(?magasins $fk_magasins): static
    {
        $this->fk_magasins = $fk_magasins;

        return $this;
    }
}
