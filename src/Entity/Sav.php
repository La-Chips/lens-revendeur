<?php

namespace App\Entity;

use App\Repository\SavRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SavRepository::class)
 */
class Sav
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="savs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="savs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Technicien;

    /**
     * @ORM\ManyToOne(targetEntity=Probleme::class, inversedBy="savs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $probleme;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $probleme_info;



    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="savs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $resultat;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $echange_client;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $echange_boutique;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $infos_sup;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $diagnostic_date;



    /**
     * @ORM\ManyToMany(targetEntity=Operations::class, inversedBy="savs")
     */
    private $operations;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $occt_cpu;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $occt_gpu;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $disques = [];

    public function __construct()
    {
        $this->operations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
        return $this->Technicien;
    }

    public function setTechnicien(?User $Technicien): self
    {
        $this->Technicien = $Technicien;

        return $this;
    }

    public function getProbleme(): ?Probleme
    {
        return $this->probleme;
    }

    public function setProbleme(?Probleme $probleme): self
    {
        $this->probleme = $probleme;

        return $this;
    }

    public function getProblemeInfo(): ?string
    {
        return $this->probleme_info;
    }

    public function setProblemeInfo(?string $probleme_info): self
    {
        $this->probleme_info = $probleme_info;

        return $this;
    }


    public function getResultat(): ?Status
    {
        return $this->resultat;
    }

    public function setResultat(?Status $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getEchangeClient(): ?string
    {
        return $this->echange_client;
    }

    public function setEchangeClient(?string $echange_client): self
    {
        $this->echange_client = $echange_client;

        return $this;
    }

    public function getEchangeBoutique(): ?string
    {
        return $this->echange_boutique;
    }

    public function setEchangeBoutique(?string $echange_boutique): self
    {
        $this->echange_boutique = $echange_boutique;

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

    public function getDiagnosticDate(): ?\DateTimeInterface
    {
        return $this->diagnostic_date;
    }

    public function setDiagnosticDate(
        ?\DateTimeInterface $diagnostic_date
    ): self {
        $this->diagnostic_date = $diagnostic_date;

        return $this;
    }



    /**
     * @return Collection|Operations[]
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operations $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations[] = $operation;
        }

        return $this;
    }

    public function removeOperation(Operations $operation): self
    {
        $this->operations->removeElement($operation);

        return $this;
    }

    public function getOcctCpu()
    {
        return $this->occt_cpu;
    }

    public function setOcctCpu($occt_cpu): self
    {
        $this->occt_cpu = $occt_cpu;

        return $this;
    }

    public function getOcctGpu()
    {
        return $this->occt_gpu;
    }

    public function setOcctGpu($occt_gpu): self
    {
        $this->occt_gpu = $occt_gpu;

        return $this;
    }

    public function getDisques(): ?array
    {
        return $this->disques;
    }

    public function setDisques(?array $disques): self
    {
        $this->disques = $disques;

        return $this;
    }
}