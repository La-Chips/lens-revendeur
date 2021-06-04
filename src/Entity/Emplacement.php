<?php

namespace App\Entity;

use App\Repository\EmplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmplacementRepository::class)
 */
class Emplacement
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Pc::class, mappedBy="emplacement")
     */
    private $pc;

    public function __construct()
    {
        $this->pc = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Pc[]
     */
    public function getPc(): Collection
    {
        return $this->pc;
    }

    public function addPc(Pc $pc): self
    {
        if (!$this->pc->contains($pc)) {
            $this->pc[] = $pc;
            $pc->setEmplacement($this);
        }

        return $this;
    }

    public function removePc(Pc $pc): self
    {
        if ($this->pc->removeElement($pc)) {
            // set the owning side to null (unless already changed)
            if ($pc->getEmplacement() === $this) {
                $pc->setEmplacement(null);
            }
        }

        return $this;
    }
}
