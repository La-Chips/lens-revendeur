<?php

namespace App\Entity;

use App\Repository\TransporteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransporteurRepository::class)
 */
class Transporteur
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="transporteur")
     */
    private $commande;

    public function __construct()
    {
        $this->commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $commande->setTransporteur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getTransporteur() === $this) {
                $commande->setTransporteur(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}