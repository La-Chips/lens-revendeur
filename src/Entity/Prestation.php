<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 */
class Prestation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="float")
     */
    private $ttc;

    /**
     * @ORM\ManyToOne(targetEntity=Devis::class, inversedBy="prestation",cascade={"persist"})
     */
    private $devis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getTtc(): ?float
    {
        return $this->ttc;
    }

    public function setTtc(float $ttc): self
    {
        $this->ttc = $ttc;

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

    public function getTotalTTC()
    {

        return $this->getTtc() * $this->getQuantite();
    }

    public function getHT($tva)
    {
        return $this->getTtc() * (1 - intval($tva) / 100);
    }

    public function getTotalHT($tva)
    {
        return $this->getTotalTTC() * (1 - intval($tva) / 100);
    }
    public function __toString()
    {
        return $this->description;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isComposant()
    {
        if ($this->type == 'composant')
            return true;
        return false;
    }

    public function getPrix()
    {
        return $this->ttc;
    }
}