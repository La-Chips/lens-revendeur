<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=20, nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="civilite", type="string", length=255, nullable=true)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="rue", type="string", length=255, nullable=true)
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5, nullable=true)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="client", orphanRemoval=true)
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=Devis::class, mappedBy="client", orphanRemoval=true)
     */
    private $devis;

    /**
     * @ORM\OneToMany(targetEntity=Reparation::class, mappedBy="client", orphanRemoval=true)
     */
    private $reparations;

    /**
     * @ORM\OneToMany(targetEntity=EchangeClient::class, mappedBy="client")
     */
    private $echangeClients;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->devis = new ArrayCollection();
        $this->reparations = new ArrayCollection();
        $this->echangeClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?string
    {
        $tel =  $this->telephone;
        if (!str_contains(' ', $tel)) {
            $tel = str_split($tel, 2);
            $tel = implode(" ", $tel);
        }
        return $tel;
    }

    public function setTelephone(?string $telephone): self
    {

        $this->telephone = $telephone;

        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(?string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

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
            $devi->setClient($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->removeElement($devi)) {
            // set the owning side to null (unless already changed)
            if ($devi->getClient() === $this) {
                $devi->setClient(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom . ' ' . $this->prenom;
    }

    /**
     * @return Collection|Reparation[]
     */
    public function getReparations(): Collection
    {
        return $this->reparations;
    }

    public function addReparation(Reparation $reparation): self
    {
        if (!$this->reparations->contains($reparation)) {
            $this->reparations[] = $reparation;
            $reparation->setClient($this);
        }

        return $this;
    }

    public function removeReparation(Reparation $reparation): self
    {
        if ($this->reparations->removeElement($reparation)) {
            // set the owning side to null (unless already changed)
            if ($reparation->getClient() === $this) {
                $reparation->setClient(null);
            }
        }

        return $this;
    }

    public function hasSAV()
    {
        foreach ($this->commandes as $key => $value) {
            if (count($value->getSavs()) > 0) {
                return true;
            }
        }
        return false;
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
            $echangeClient->setClient($this);
        }

        return $this;
    }

    public function removeEchangeClient(EchangeClient $echangeClient): self
    {
        if ($this->echangeClients->removeElement($echangeClient)) {
            // set the owning side to null (unless already changed)
            if ($echangeClient->getClient() === $this) {
                $echangeClient->setClient(null);
            }
        }

        return $this;
    }
}