<?php

namespace App\Entity;

use App\Repository\ProblemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProblemeRepository::class)
 */
class Probleme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Sav::class, mappedBy="probleme")
     */
    private $savs;

    /**
     * @ORM\ManyToMany(targetEntity=Reparation::class, mappedBy="problemes")
     */
    private $reparations;



    public function __construct()
    {
        $this->savs = new ArrayCollection();
        $this->reparations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $sav->setProbleme($this);
        }

        return $this;
    }

    public function removeSav(Sav $sav): self
    {
        if ($this->savs->removeElement($sav)) {
            // set the owning side to null (unless already changed)
            if ($sav->getProbleme() === $this) {
                $sav->setProbleme(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->description;
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
            $reparation->addProbleme($this);
        }

        return $this;
    }

    public function removeReparation(Reparation $reparation): self
    {
        if ($this->reparations->removeElement($reparation)) {
            $reparation->removeProbleme($this);
        }

        return $this;
    }
}
