<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
class Utilisateurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_de_naissance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_inscription = null;

    #[ORM\OneToMany(mappedBy: 'fk_utilisateurs', targetEntity: Commandes::class)]
    private Collection $commandes;

    #[ORM\Column(length: 20)]
    private ?string $tel = null;

    #[ORM\ManyToMany(targetEntity: Sport::class, mappedBy: 'utilisateurs')]
    private Collection $sports;

    #[ORM\OneToMany(mappedBy: 'responsableLegal', targetEntity: Enfants::class)]
    private Collection $lesEnfants;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->sports = new ArrayCollection();
        $this->lesEnfants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): static
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): static
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    /**
     * @return Collection<int, Commandes>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commandes $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setFkUtilisateurs($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getFkUtilisateurs() === $this) {
                $commande->setFkUtilisateurs(null);
            }
        }

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }
    
    /**
     * @return Collection<int, Sport>
     */
    public function getSports(): Collection
    {
        return $this->sports;
    }

    public function addSport(Sport $sport): static
    {
        if (!$this->sports->contains($sport)) {
            $this->sports->add($sport);
            $sport->addUtilisateur($this);
        }

        return $this;
    }

    public function removeSport(Sport $sport): static
    {
        if ($this->sports->removeElement($sport)) {
            $sport->removeUtilisateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Enfants>
     */
    public function getLesEnfants(): Collection
    {
        return $this->lesEnfants;
    }

    public function addLesEnfant(Enfants $lesEnfant): static
    {
        if (!$this->lesEnfants->contains($lesEnfant)) {
            $this->lesEnfants->add($lesEnfant);
            $lesEnfant->setResponsableLegal($this);
        }

        return $this;
    }

    public function removeLesEnfant(Enfants $lesEnfant): static
    {
        if ($this->lesEnfants->removeElement($lesEnfant)) {
            // set the owning side to null (unless already changed)
            if ($lesEnfant->getResponsableLegal() === $this) {
                $lesEnfant->setResponsableLegal(null);
            }
        }

        return $this;
    }
}
