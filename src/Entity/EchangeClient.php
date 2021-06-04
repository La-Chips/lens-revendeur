<?php

namespace App\Entity;

use App\Repository\EchangeClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EchangeClientRepository::class)
 */
class EchangeClient
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
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="echangeClients")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="echangeClients")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=Devis::class, inversedBy="echangeClients")
     */
    private $devis;

    /**
     * @ORM\ManyToOne(targetEntity=Reparation::class, inversedBy="echangeClients")
     */
    private $reparation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $methode;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $raison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date->format('d/m/Y H:i:s');;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
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

    public function getDevis(): ?Devis
    {
        return $this->devis;
    }

    public function setDevis(?Devis $devis): self
    {
        $this->devis = $devis;

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

    public function getMethode(): ?string
    {
        return $this->methode;
    }

    public function setMethode(string $methode): self
    {
        $this->methode = $methode;

        return $this;
    }

    public function getRaison(): ?string
    {
        return $this->raison;
    }

    public function setRaison(?string $raison): self
    {
        $this->raison = $raison;

        return $this;
    }
}
