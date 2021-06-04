<?php

namespace App\Entity;

use App\Repository\ReparationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReparationRepository::class)
 */
class Reparation
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
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="reparations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $materiel;



    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $infos_sup;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="reparations")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=EchangeClient::class, mappedBy="reparation")
     */
    private $echangeClients;

    /**
     * @ORM\ManyToMany(targetEntity=Probleme::class, inversedBy="reparations")
     */
    private $problemes;

    /**
     * @ORM\OneToOne(targetEntity=Diagnostic::class, cascade={"persist", "remove"})
     */
    private $diag;

    /**
     * @ORM\OneToMany(targetEntity=Devis::class, mappedBy="reparation",cascade={"persist"})
     */
    private $devis;

    /**
     * @ORM\OneToMany(targetEntity=Etapes::class, mappedBy="reparation",cascade={"persist"})
     */
    private $etapes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $infos_pause;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $casier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equipement_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equipement_3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $equipement_4;

    /**
     * @ORM\Column(type="boolean")
     */
    private $livraison;

    public function __construct()
    {
        $this->echangeClients = new ArrayCollection();
        $this->problemes = new ArrayCollection();
        $this->devis = new ArrayCollection();
        $this->etapes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date->format('d/m/Y H:i:s');
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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getMateriel(): ?string
    {
        return $this->materiel;
    }

    public function setMateriel(string $materiel): self
    {
        $this->materiel = $materiel;

        return $this;
    }



    public function getInfosSup(): ?string
    {
        return $this->infos_sup;
    }

    public function setInfosSup(?string $infos_sup): self
    {
        $this->infos_sup = $infos_sup;

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
     * @return Collection|EchangeClient[]
     */
    public function getEchangeClients(): Collection
    {
        return $this->echangeClients;
    }

    public function addEchangeClient(EchangeClient $echangeClient): self
    {
        if (!$this->echangeClients->contains($echangeClient)) {
            $this->echangeClients[] = $echangeClient;
            $echangeClient->setReparation($this);
        }

        return $this;
    }

    public function removeEchangeClient(EchangeClient $echangeClient): self
    {
        if ($this->echangeClients->removeElement($echangeClient)) {
            // set the owning side to null (unless already changed)
            if ($echangeClient->getReparation() === $this) {
                $echangeClient->setReparation(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->numero;
    }

    /**
     * @return Collection|Probleme[]
     */
    public function getProblemes(): Collection
    {
        return $this->problemes;
    }

    public function addProbleme(Probleme $probleme): self
    {
        if (!$this->problemes->contains($probleme)) {
            $this->problemes[] = $probleme;
        }

        return $this;
    }

    public function removeProbleme(Probleme $probleme): self
    {
        $this->problemes->removeElement($probleme);

        return $this;
    }

    public function getDiag(): ?Diagnostic
    {
        return $this->diag;
    }

    public function setDiag(?Diagnostic $diag): self
    {
        $this->diag = $diag;

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
            $devi->setReparation($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->removeElement($devi)) {
            // set the owning side to null (unless already changed)
            if ($devi->getReparation() === $this) {
                $devi->setReparation(null);
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
            $etape->setReparation($this);
        }

        return $this;
    }

    public function removeEtape(Etapes $etape): self
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getReparation() === $this) {
                $etape->setReparation(null);
            }
        }

        return $this;
    }
    public function getValidateDevis()
    {
        foreach ($this->getDevis() as $key => $value) {
            if ($value->getStatus()->getId() == 14)
                return $value;
        }
        return null;
    }

    public function getInfosPause(): ?string
    {
        return $this->infos_pause;
    }

    public function setInfosPause(?string $infos_pause): self
    {
        $this->infos_pause = $infos_pause;

        return $this;
    }

    public function getCasier(): ?int
    {
        return $this->casier;
    }

    public function setCasier(?int $casier): self
    {
        $this->casier = $casier;

        return $this;
    }

    public function getEquipement2(): ?string
    {
        return $this->equipement_2;
    }

    public function setEquipement2(?string $equipement_2): self
    {
        $this->equipement_2 = $equipement_2;

        return $this;
    }

    public function getEquipement3(): ?string
    {
        return $this->equipement_3;
    }

    public function setEquipement3(?string $equipement_3): self
    {
        $this->equipement_3 = $equipement_3;

        return $this;
    }

    public function getEquipement4(): ?string
    {
        return $this->equipement_4;
    }

    public function setEquipement4(?string $equipement_4): self
    {
        $this->equipement_4 = $equipement_4;

        return $this;
    }

    public function getLivraison(): ?bool
    {
        return $this->livraison;
    }

    public function setLivraison(bool $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }
}