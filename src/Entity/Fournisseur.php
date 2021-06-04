<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseurRepository::class)
 */
class Fournisseur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="fournisseur")
     */
    private $commande;

    /**
     * @ORM\OneToMany(targetEntity=Details::class, mappedBy="fournisseur")
     */
    private $details;

    public function __construct()
    {
        $this->commande = new ArrayCollection();
        $this->details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
            $commande->setFournisseur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getFournisseur() === $this) {
                $commande->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Details[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(Details $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
            $detail->setFournisseur($this);
        }

        return $this;
    }

    public function removeDetail(Details $detail): self
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getFournisseur() === $this) {
                $detail->setFournisseur(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
