<?php

namespace App\Entity;

use App\Entity\Pc;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RevendeurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=RevendeurRepository::class)
 */
class Revendeur
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SIRET;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contact;

    /**
     * @ORM\OneToMany(targetEntity=PcRevendeur::class, mappedBy="revendeur",cascade={"persist"})
     */
    private $pcRevendeurs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $offre;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;




    public function __construct()
    {
        $this->pcs = new ArrayCollection();
        $this->pcRevendeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSIRET(): ?string
    {
        return $this->SIRET;
    }

    public function setSIRET(?string $SIRET): self
    {
        $this->SIRET = $SIRET;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
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
            $pcRevendeur->setRevendeur($this);
        }

        return $this;
    }

    public function removePcRevendeur(PcRevendeur $pcRevendeur): self
    {
        if ($this->pcRevendeurs->removeElement($pcRevendeur)) {
            // set the owning side to null (unless already changed)
            if ($pcRevendeur->getRevendeur() === $this) {
                $pcRevendeur->setRevendeur(null);
            }
        }

        return $this;
    }

    public function havePc(Pc $pc)
    {
        foreach ($this->pcRevendeurs as $key => $value) {
            if ($pc->getId() == $value->getPc()->getId()) {
                return true;
            }
        }
        return false;
    }

    public function getPcRevendeurWithPc(Pc $pc)
    {
        foreach ($this->pcRevendeurs as $key => $value) {
            if ($pc->getId() == $value->getPc()->getId()) {
                return $value;
            }
        }
        return null;
    }

    public function getOffre(): ?string
    {
        return $this->offre;
    }

    public function setOffre(?string $offre): self
    {
        $this->offre = $offre;

        return $this;
    }
}