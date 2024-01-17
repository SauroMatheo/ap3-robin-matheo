<?php

namespace App\Entity;

use App\Repository\EnfantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/*
Classe Enfants:
Définit les enfants des clients/utilisateurs. Demandé, probablement à des fins promotionnelles

?int age:                           Age de l'enfant
?Utilisateurs responsableLegal:     Essentiellement le client étant responsable de l'enfant
*/
#[ORM\Entity(repositoryClass: EnfantsRepository::class)]
class Enfants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\ManyToOne(inversedBy: 'lesEnfants')]
    private ?Utilisateurs $responsableLegal = null;

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

    public function getResponsableLegal(): ?Utilisateurs
    {
        return $this->responsableLegal;
    }

    public function setResponsableLegal(?Utilisateurs $responsableLegal): static
    {
        $this->responsableLegal = $responsableLegal;

        return $this;
    }
}
