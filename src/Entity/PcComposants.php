<?php

namespace App\Entity;

use App\Repository\PcComposantsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PcComposantsRepository::class)
 */
class PcComposants
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Pc::class, inversedBy="pcComposants")
     */
    private $pc;

    /**
     * @ORM\ManyToOne(targetEntity=Composant::class, inversedBy="pcComposants")
     */
    private $composant;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getComposant(): ?Composant
    {
        return $this->composant;
    }

    public function setComposant(?Composant $composant): self
    {
        $this->composant = $composant;

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

    public function substract($qte)
    {
        if ($this->quantite > 0) {
            $this->quantite = $this->quantite - $qte;
        }
    }
    public function add($qte)
    {
        $this->quantite = $this->quantite + $qte;
    }
}