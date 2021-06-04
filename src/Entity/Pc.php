<?php

namespace App\Entity;

use App\Repository\PcRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

/**
 * Pc
 *
 * @ORM\Table(name="pc")
 * @ORM\Entity(repositoryClass=PcRepository::class)
 */
class Pc
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
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=255, nullable=false)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255, nullable=false)
     */
    private $modele;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Details", mappedBy="pc")
     */
    private $details;



    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Emplacement::class, inversedBy="pc")
     */
    private $emplacement;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sku2;



    /**
     * @ORM\OneToMany(targetEntity=PcComposants::class, mappedBy="pc",cascade={"persist"})
     */
    private $pcComposants;

    /**
     * @ORM\ManyToMany(targetEntity=Revendeur::class, mappedBy="pcs")
     */
    private $revendeurs;

    /**
     * @ORM\OneToMany(targetEntity=PcRevendeur::class, mappedBy="pc")
     */
    private $pcRevendeurs;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $images = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fiche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $delai;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->details = new \Doctrine\Common\Collections\ArrayCollection();
        $this->composant = new ArrayCollection();
        $this->pcComposants = new ArrayCollection();
        $this->revendeurs = new ArrayCollection();
        $this->pcRevendeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

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

    public function getEmplacement()
    {
        if ($this->emplacement == null) {
            return ' ';
        }
        return $this->emplacement;
    }

    public function setEmplacement(?Emplacement $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function substract($qte)
    {
        $this->Quantite = $this->Quantite - $qte;
    }

    public function getQteFab()
    {
        if (!$this->isBuildable()) {
            return 0;
        }

        $qte = null;

        foreach ($this->pcComposants as $key => $pcCompo) {
            $composant = $pcCompo->getComposant();

            if ($qte == null) {
                $qte = $composant->getQuantite() / $pcCompo->getQuantite();
                $qte = floor($qte);
            } elseif ($qte > ($composant->getQuantite() / $pcCompo->getQuantite())) {
                $qte = $composant->getQuantite() / $pcCompo->getQuantite();
            }
        }

        return $qte;
    }

    private function isBuildable()
    {
        if (count($this->getComposants()) == 0) {
            return false;
        }

        foreach ($this->getComposants() as $key => $value) {

            if ($value->getQuantite() == 0) {
                return false;
            }
        }
        return true;
    }

    public function getCompoLimitant()
    {
        $compoLim = null;
        $qteLim = null;
        $out = [];

        foreach ($this->getPcComposants() as $key => $value) {
            $compo = $value->getComposant();




            if ($compoLim == null) {
                $compoLim = $compo;
                $qteLim = floor($value->getQuantite());


                array_push($out, $value);
            } elseif (floor($compoLim->getQuantite() / $qteLim) > floor($compo->getQuantite() / $value->getQuantite())) {

                $out = [];
                $compoLim = $compo;
                $qteLim = floor($value->getQuantite());

                array_push($out, $value);
            } elseif (floor($compoLim->getQuantite() / $qteLim) == floor($compo->getQuantite() / $value->getQuantite())) {
                array_push($out, $value);
            }
        }
        return $out;
    }

    public function build()
    {
        foreach ($this->getComposants() as $key => $value) {
            $pcComposant = $this->getPcComposant($value);
            $value->substract($pcComposant->getQuantite());
        }
    }


    public function __toString()
    {
        return $this->modele;
    }

    public function getHT($tva)
    {
        return $this->prix * (1 - $tva / 100);
    }

    public function getSku2(): ?string
    {
        return $this->sku2;
    }

    public function setSku2(?string $sku2): self
    {
        $this->sku2 = $sku2;

        return $this;
    }



    /**
     * @return Collection|PcComposants[]
     */

    public function getPcComposants()
    {
        return $this->pcComposants;
    }

    public function setPcComposants($pcComposants)
    {
        $this->pcComposants = $pcComposants;
        return $this;
    }

    public function getPcComposant($composant)
    {
        foreach ($this->pcComposants as $key => $value) {
            if ($value->getComposant() == $composant) {
                return $value;
            }
        }
        return null;
    }

    public function getComposants(): Collection
    {
        $composants = new ArrayCollection();
        foreach ($this->pcComposants as $key => $value) {
            $composants->add($value->getComposant());
        }

        return $composants;
    }



    public function addComposant($composant): self
    {
        $pcComposant = new PcComposants();
        $pcComposant->setPc($this);
        $pcComposant->setComposant($composant);
        $pcComposant->setQuantite(1);

        if (!$this->haveCompo($composant)) {
            $this->pcComposants[] = $pcComposant;
            $pcComposant->setPc($this);
        } else {
            $this->getPcComposant($composant)->add(1);
        }

        return $this;
    }

    public function removeComposant($composant)
    {

        $pcCompo = $this->getPcComposant($composant);
        $this->removePcComposant($pcCompo);
    }

    public function removePcComposant(PcComposants $pcComposant): self
    {
        if ($this->pcComposants->removeElement($pcComposant)) {
            // set the owning side to null (unless already changed)
            if ($pcComposant->getPc() === $this) {
                $pcComposant->setPc(null);
            }
        }

        return $this;
    }



    public function haveCompo($composant)
    {
        foreach ($this->getComposants() as $key => $value) {

            if ($value->getId() == $composant->getId()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return Collection|Revendeur[]
     */
    public function getRevendeurs(): Collection
    {
        return $this->revendeurs;
    }

    public function addRevendeur(Revendeur $revendeur): self
    {
        if (!$this->revendeurs->contains($revendeur)) {
            $this->revendeurs[] = $revendeur;
            $revendeur->addPc($this);
        }

        return $this;
    }

    public function removeRevendeur(Revendeur $revendeur): self
    {
        if ($this->revendeurs->removeElement($revendeur)) {
            $revendeur->removePc($this);
        }

        return $this;
    }

    /**
     * @return Collection|PcRevendeur[]
     */
    public function getPcRevendeurs(): Collection
    {
        return $this->pcRevendeurs;
    }

    public function addPcRevendeur(PcRevendeur $pcRevendeur): self
    {
        if (!$this->pcRevendeurs->contains($pcRevendeur)) {
            $this->pcRevendeurs[] = $pcRevendeur;
            $pcRevendeur->setPc($this);
        }

        return $this;
    }

    public function removePcRevendeur(PcRevendeur $pcRevendeur): self
    {
        if ($this->pcRevendeurs->removeElement($pcRevendeur)) {
            // set the owning side to null (unless already changed)
            if ($pcRevendeur->getPc() === $this) {
                $pcRevendeur->setPc(null);
            }
        }

        return $this;
    }

    public function getImages(): ?array
    {
        if ($this->images == null) {
            $this->setImages([]);
        }
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function addImage($image)
    {
        array_push($this->images, $image);
        return $this;
    }
    public function removeImage($image)
    {
        $index = array_search($image, $this->images);
        array_splice($this->images, $index, 1);
        return $this;
    }

    public function getDisplayImg()
    {
        if ($this->images == null || count($this->images) == 0) {
            return '../pc-tower.svg';
        } else {
            return $this->images[0];
        }
    }

    public function getFiche(): ?string
    {
        return $this->fiche;
    }

    public function setFiche(?string $fiche): self
    {
        $this->fiche = $fiche;

        return $this;
    }

    public function getDelai(): ?string
    {
        return $this->delai;
    }

    public function setDelai(?string $delai): self
    {
        $this->delai = $delai;

        return $this;
    }
}