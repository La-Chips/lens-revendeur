<?php

namespace App\Entity;

use App\Repository\PcRevendeurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PcRevendeurRepository::class)
 */
class PcRevendeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Revendeur::class, inversedBy="pcRevendeurs",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $revendeur;

    /**
     * @ORM\ManyToOne(targetEntity=Pc::class, inversedBy="pcRevendeurs",cascade={"persist"})
     */
    private $pc;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRevendeur(): ?Revendeur
    {
        return $this->revendeur;
    }

    public function setRevendeur(?Revendeur $revendeur): self
    {
        $this->revendeur = $revendeur;

        return $this;
    }

    public function getPc(): ?Pc
    {
        return $this->pc;
    }

    public function setPc(?Pc $pc): self
    {
        $this->pc = $pc;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}