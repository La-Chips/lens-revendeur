<?php

namespace App\Entity;

use App\Repository\CommandeRepository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="", columns={"numero"})})
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */

class Commande
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
     * @ORM\Column(name="numero", type="string", length=255, nullable=false)
     */
    private $numero;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float", precision=10, scale=0, nullable=false)
     */
    private $tva;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_limite_exp", type="datetime", nullable=true)
     */
    private $dateLimiteExp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_exp", type="datetime", nullable=true)
     */
    private $dateExp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_order", type="datetime", nullable=false)
     */
    private $dateOrder;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="commande")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Transporteur::class, inversedBy="commande")
     */
    private $transporteur;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=Sav::class, mappedBy="commande", orphanRemoval=true)
     */
    private $savs;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="commande")
     */
    private $fournisseur;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $infos;

    /**
     * @ORM\OneToMany(targetEntity=Details::class, mappedBy="commande",cascade={"persist"})
     */
    private $contenu;

    /**
     * @ORM\OneToMany(targetEntity=Etapes::class, mappedBy="commande",cascade={"persist"})
     */
    private $etapes;

    /**
     * @ORM\OneToMany(targetEntity=EchangeClient::class, mappedBy="commande")
     */
    private $echangeClients;

    public function __construct()
    {
        $this->details = new ArrayCollection();
        $this->savs = new ArrayCollection();
        $this->contenu = new ArrayCollection();
        $this->etapes = new ArrayCollection();
        $this->echangeClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getDateLimiteExp(): string
    {
        if ($this->dateLimiteExp == null) {
            return '';
        }

        return $this->dateLimiteExp->format('d/m/Y H:i:s');
    }

    public function setDateLimiteExp(\DateTime $dateLimiteExp): self
    {
        $this->dateLimiteExp = $dateLimiteExp;

        return $this;
    }

    public function getDateExp(): ?\Datetime
    {
        return $this->dateExp;
    }


    public function setDateExp(\DateTime $dateExp): self
    {
        $this->dateExp = $dateExp;

        return $this;
    }
    public function getDateOrder(): string
    {
        return $this->dateOrder->format('d/m/Y H:i:s');
    }

    public function setDateOrder(\DateTime $dateOrder): self
    {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    public function getDate()
    {
        return $this->getDateOrder();
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

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTransporteur(): ?Transporteur
    {
        return $this->transporteur;
    }

    public function setTransporteur(?Transporteur $transporteur): self
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    /**
     * @return Collection|Sav[]
     */
    public function getSavs(): Collection
    {
        return $this->savs;
    }

    public function addSav(Sav $sav): self
    {
        if (!$this->savs->contains($sav)) {
            $this->savs[] = $sav;
            $sav->setCommande($this);
        }

        return $this;
    }

    public function removeSav(Sav $sav): self
    {
        if ($this->savs->removeElement($sav)) {
            // set the owning side to null (unless already changed)
            if ($sav->getCommande() === $this) {
                $sav->setCommande(null);
            }
        }

        return $this;
    }

    public function isLate()
    {
        if (
            $this->dateLimiteExp < new \DateTime('NOW') &&
            $this->dateLimiteExp != null &&
            !in_array($this->status->getId(), [1, 7])
        ) {
            return true;
        }
        return false;
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

    public function getInfos(): ?string
    {
        return $this->infos;
    }

    public function setInfos(?string $infos): self
    {
        $this->infos = $infos;

        return $this;
    }

    /**
     * @return Collection|Details[]
     */
    public function getContenu(): Collection
    {
        return $this->contenu;
    }

    public function addContenu(Details $contenu): self
    {
        if (!$this->contenu->contains($contenu)) {
            $this->contenu[] = $contenu;
            $contenu->setCommande($this);
        }

        return $this;
    }

    public function removeContenu(Details $contenu): self
    {
        if ($this->contenu->removeElement($contenu)) {
            // set the owning side to null (unless already changed)
            if ($contenu->getCommande() === $this) {
                $contenu->setCommande(null);
            }
        }

        return $this;
    }

    public function containsCompo($compo)
    {
        foreach ($this->contenu as $key => $contenu) {
            if ($contenu->getArticle()->getId() == $compo->getId()) {
                return true;
            }
        }
        return false;
    }

    public function getArticle($article)
    {
        foreach ($this->contenu as $key => $contenu) {
            if ($contenu->getArticle()->getId() == $article->getId()) {
                return $contenu;
            }
        }
        return null;
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
            $etape->setCommande($this);
        }

        return $this;
    }

    public function removeEtape(Etapes $etape): self
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getCommande() === $this) {
                $etape->setCommande(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->numero;
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
            $echangeClient->setCommande($this);
        }

        return $this;
    }

    public function removeEchangeClient(EchangeClient $echangeClient): self
    {
        if ($this->echangeClients->removeElement($echangeClient)) {
            // set the owning side to null (unless already changed)
            if ($echangeClient->getCommande() === $this) {
                $echangeClient->setCommande(null);
            }
        }

        return $this;
    }

    public function getTotalTTC()
    {
        $total = 0;
        if (count($this->contenu) > 0) {
            foreach ($this->contenu as $key => $value) {
                $total += $value->getArticle()->getPrix() * $value->getQuantite();
            }
        }
        return $total;
    }

    public function getTotalHT($tva)
    {
        return $this->getTotalTTC() * (1 - intval($tva) / 100);
    }

    public function getTotalTVA($tva)
    {
        return $this->getTotalTTC() * ($tva / 100);
    }
}