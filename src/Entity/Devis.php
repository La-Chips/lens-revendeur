<?php

namespace App\Entity;

use App\Repository\DevisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DevisRepository::class)
 */
class Devis
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
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=Details::class, mappedBy="devis",cascade={"persist"})
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="devis")
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Etapes::class, inversedBy="devis",cascade={"persist"})
     */
    private $etapes;

    /**
     * @ORM\OneToMany(targetEntity=EchangeClient::class, mappedBy="devis")
     */
    private $echangeClients;

    /**
     * @ORM\ManyToOne(targetEntity=Reparation::class, inversedBy="devis",cascade={"persist"})
     */
    private $reparation;

    /**
     * @ORM\OneToMany(targetEntity=Prestation::class, mappedBy="devis",cascade={"persist"})
     */
    private $prestation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $infos;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->etapes = new ArrayCollection();
        $this->echangeClients = new ArrayCollection();
        $this->prestation = new ArrayCollection();
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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

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

    /**
     * @return Collection|Details[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Details $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setDevis($this);
        }

        return $this;
    }

    public function removeArticle(Details $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getDevis() === $this) {
                $article->setDevis(null);
            }
        }

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

    public function getTotalTTC()
    {
        $total = 0;
        if (count($this->articles) > 0) {
            foreach ($this->articles as $key => $value) {
                $total += $value->getArticle()->getPrix() * $value->getQuantite();
            }
        } else {
            foreach ($this->prestation as $key => $value) {
                $total += $value->getTtc() * $value->getQuantite();
            }
        }
        return $total;
    }

    public function getTotalHT($tva)
    {
        return $this->getTotalTTC() * (1 - intval($tva) / 100);
    }

    public function containsArticle($item)
    {
        foreach ($this->articles as $key => $article) {
            if ($article->getArticle()->getId() == $item->getId()) {
                return true;
            }
        }
        return false;
    }

    public function getArticle($item)
    {
        foreach ($this->articles as $key => $article) {
            if ($article->getArticle()->getId() == $item->getId()) {
                return $article;
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
        }

        return $this;
    }

    public function removeEtape(Etapes $etape): self
    {
        $this->etapes->removeElement($etape);

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
            $echangeClient->setDevis($this);
        }

        return $this;
    }

    public function removeEchangeClient(EchangeClient $echangeClient): self
    {
        if ($this->echangeClients->removeElement($echangeClient)) {
            // set the owning side to null (unless already changed)
            if ($echangeClient->getDevis() === $this) {
                $echangeClient->setDevis(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->numero;
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

    /**
     * @return Collection|Prestation[]
     */
    public function getPrestation(): Collection
    {
        return $this->prestation;
    }

    public function addPrestation(Prestation $prestation): self
    {
        if (!$this->prestation->contains($prestation)) {
            $this->prestation[] = $prestation;
            $prestation->setDevis($this);
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): self
    {
        if ($this->prestation->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getDevis() === $this) {
                $prestation->setDevis(null);
            }
        }

        return $this;
    }

    public function clearPrestation()
    {
        foreach ($this->getPrestation() as $key => $value) {
            $this->removePrestation($value);
        }
    }
    public function clearArticle()
    {
        foreach ($this->getArticles() as $key => $value) {
            $this->removeArticle($value);
        }
    }
    public function getTotalTVA($tva)
    {
        return $this->getTotalTTC() * ($tva / 100);
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
}