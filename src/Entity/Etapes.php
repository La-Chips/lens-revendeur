<?php

namespace App\Entity;

use App\Repository\EtapesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtapesRepository::class)
 */
class Etapes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="etapes")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="etapes")
     */
    private $technicien;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="etapes")
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Devis::class, mappedBy="etapes")
     */
    private $devis;

    /**
     * @ORM\ManyToOne(targetEntity=Reparation::class, inversedBy="etapes")
     */
    private $reparation;

    public function __construct()
    {
        $this->status = new ArrayCollection();
        $this->devis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function removeStatus(Status $status): self
    {
        if ($this->status->removeElement($status)) {
            // set the owning side to null (unless already changed)
            if ($status->getEtapes() === $this) {
                $status->setEtapes(null);
            }
        }

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date->format('d/m/y H:m:s');
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function __toString()
    {
        return $this->status->getLibelle();
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getTechnicien(): ?User
    {
        return $this->technicien;
    }

    public function setTechnicien(?User $technicien): self
    {
        $this->technicien = $technicien;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevi(Devis $devi): self
    {
        if (!$this->devis->contains($devi)) {
            $this->devis[] = $devi;
            $devi->addEtape($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->removeElement($devi)) {
            $devi->removeEtape($this);
        }

        return $this;
    }

    public function getReparation(): ?Reparation
    {
        return $this->reparation;
    }

    public function setReparation(?Reparation $reparation): self
    {
        $this->reparation = $reparation;

        return $this;
    }
}