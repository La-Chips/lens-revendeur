<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
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
    private $Libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="status")
     */
    private $commande;

    /**
     * @ORM\OneToMany(targetEntity=Sav::class, mappedBy="resultat")
     */
    private $savs;

    /**
     * @ORM\OneToMany(targetEntity=Etapes::class, mappedBy="status")
     */
    private $etapes;

    /**
     * @ORM\OneToMany(targetEntity=Devis::class, mappedBy="status")
     */
    private $devis;

    /**
     * @ORM\OneToMany(targetEntity=Reparation::class, mappedBy="status")
     */
    private $reparations;

    public function __construct()
    {
        $this->commande = new ArrayCollection();
        $this->savs = new ArrayCollection();
        $this->etapes = new ArrayCollection();
        $this->devis = new ArrayCollection();
        $this->reparations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

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
            $commande->setStatus($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getStatus() === $this) {
                $commande->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sav[]
     */
    public function getSavs(): Collection
    {
        return $this->savs;
    }

    public function addSav(Sav $sav): self
    {
        if (!$this->savs->contains($sav)) {
            $this->savs[] = $sav;
            $sav->setResultat($this);
        }

        return $this;
    }

    public function removeSav(Sav $sav): self
    {
        if ($this->savs->removeElement($sav)) {
            // set the owning side to null (unless already changed)
            if ($sav->getResultat() === $this) {
                $sav->setResultat(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Etapes[]
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etapes $etape): self
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes[] = $etape;
            $etape->setStatus($this);
        }

        return $this;
    }

    public function removeEtape(Etapes $etape): self
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getStatus() === $this) {
                $etape->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevis(Devis $devis): self
    {
        if (!$this->devis->contains($devis)) {
            $this->devis[] = $devis;
            $devis->setStatus($this);
        }

        return $this;
    }

    public function removeDevis(Devis $devis): self
    {
        if ($this->devis->removeElement($devis)) {
            // set the owning side to null (unless already changed)
            if ($devis->getStatus() === $this) {
                $devis->setStatus(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }

    /**
     * @return Collection|Reparation[]
     */
    public function getReparations(): Collection
    {
        return $this->reparations;
    }

    public function addReparation(Reparation $reparation): self
    {
        if (!$this->reparations->contains($reparation)) {
            $this->reparations[] = $reparation;
            $reparation->setStatus($this);
        }

        return $this;
    }

    public function removeReparation(Reparation $reparation): self
    {
        if ($this->reparations->removeElement($reparation)) {
            // set the owning side to null (unless already changed)
            if ($reparation->getStatus() === $this) {
                $reparation->setStatus(null);
            }
        }

        return $this;
    }
}