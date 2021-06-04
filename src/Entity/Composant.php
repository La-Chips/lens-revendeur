<?php

namespace App\Entity;

use App\Repository\ComposantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ComposantRepository::class)
 */
class Composant
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
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="composants")
     */
    private $categorie;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ISBN;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_shopify;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $specs;

    /**
     * @ORM\OneToMany(targetEntity=PcComposants::class, mappedBy="composant")
     */
    private $pcComposants;

    public function __construct()
    {
        $this->pcs = new ArrayCollection();
        $this->details = new ArrayCollection();
        $this->pcComposants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function substract($qte)
    {
        if ($this->quantite > 0) {
            $this->quantite = $this->quantite - $qte;
        } else {;
            $sujet = 'Rupture ' . $this->__toString();
            $message = 'Le composant ' . $this->__toString() . 'est en rupture';
            $headers = 'From: webmaster@example.com';
            mail('stock.@micro76.fr', $sujet, $message, $headers);
        }
    }
    public function add($qte)
    {
        $this->quantite = $this->quantite + $qte;
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }



    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(?string $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdShopify(): ?string
    {
        return $this->id_shopify;
    }

    public function setIdShopify(?string $id_shopify): self
    {
        $this->id_shopify = $id_shopify;

        return $this;
    }

    public function getSpecs(): ?string
    {
        return $this->specs;
    }

    public function setSpecs(?string $specs): self
    {
        $this->specs = $specs;

        return $this;
    }
    public function __toString()
    {
        return $this->marque . ' ' . $this->model;
    }

    public function getHT($tva)
    {
        return $this->prix * (1 - $tva / 100);
    }

    /**
     * @return Collection|PcComposants[]
     */
    public function getPcComposants(): Collection
    {
        return $this->pcComposants;
    }

    public function addPcComposant(PcComposants $pcComposant): self
    {
        if (!$this->pcComposants->contains($pcComposant)) {
            $this->pcComposants[] = $pcComposant;
            $pcComposant->setComposant($this);
        }

        return $this;
    }

    public function removePcComposant(PcComposants $pcComposant): self
    {
        if ($this->pcComposants->removeElement($pcComposant)) {
            // set the owning side to null (unless already changed)
            if ($pcComposant->getComposant() === $this) {
                $pcComposant->setComposant(null);
            }
        }

        return $this;
    }
}