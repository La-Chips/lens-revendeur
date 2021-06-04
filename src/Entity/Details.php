<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Details
 *
 * @ORM\Table(name="details")
 * @ORM\Entity
 */
class Details
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="object")
     */
    private $article;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="details")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="contenu",cascade={"persist"})
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=Devis::class, inversedBy="articles")
     */
    private $devis;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="details")
     */
    private $fournisseur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->composant = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pc = new \Doctrine\Common\Collections\ArrayCollection();
        $this->service = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function setArticle($article): self
    {
        $this->article = $article;

        return $this;
    }

    public function addQuantite($qte)
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

    public function getType(): ?Categorie
    {
        return $this->type;
    }

    public function setType(?Categorie $type): self
    {
        $this->type = $type;

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

    public function __toString()
    {
        if ($this->type->getId() == 16) {
            return $this->article->getModele();
        } else {
            return $this->article->getModel();
        }
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

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function isPc()
    {

        if ($this->type->getId() == 16) {
            return true;
        }
        return false;
    }
    public function isComposant()
    {

        if (!$this->isPc() && !$this->isService()) {
            return true;
        }
        return false;
    }
    public function isService()
    {
        if ($this->type->getId() == 18) {
            return true;
        }
        return false;
    }

    public function getTotalTTC()
    {
        $total = 0;

        $total = $this->getArticle()->getPrix() * $this->getQuantite();

        return $total;
    }

    public function getTotalHT($tva)
    {
        return $this->getTotalTTC() * (1 - intval($tva) / 100);
    }
}