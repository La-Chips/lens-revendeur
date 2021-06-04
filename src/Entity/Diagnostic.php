<?php

namespace App\Entity;

use App\Repository\DiagnosticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiagnosticRepository::class)
 */
class Diagnostic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $SSD1;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $SDD2;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $HDD1;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $HDD2;

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $HDD3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CPU;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $passmark;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $temp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adw;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $glary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mbm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $temp_preftech;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $obs1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $obs2;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="diagnostics")
     * @ORM\JoinColumn(nullable=true)
     */
    private $technicien;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSSD1()
    {
        return $this->SSD1;
    }

    public function setSSD1($SSD1): self
    {
        $this->SSD1 = $SSD1;

        return $this;
    }

    public function getSSD2()
    {
        return $this->SDD2;
    }

    public function setSSD2($SDD2): self
    {
        $this->SDD2 = $SDD2;

        return $this;
    }

    public function getHDD1()
    {
        return $this->HDD1;
    }

    public function setHDD1($HDD1): self
    {
        $this->HDD1 = $HDD1;

        return $this;
    }

    public function getHDD2()
    {
        return $this->HDD2;
    }

    public function setHDD2($HDD2): self
    {
        $this->HDD2 = $HDD2;

        return $this;
    }

    public function getHDD3()
    {
        return $this->HDD3;
    }

    public function setHDD3($HDD3): self
    {
        $this->HDD3 = $HDD3;

        return $this;
    }

    public function getCPU(): ?string
    {
        return $this->CPU;
    }

    public function setCPU(?string $CPU): self
    {
        $this->CPU = $CPU;

        return $this;
    }

    public function getPassmark(): ?string
    {
        return $this->passmark;
    }

    public function setPassmark(?string $passmark): self
    {
        $this->passmark = $passmark;

        return $this;
    }

    public function getTemp(): ?string
    {
        return $this->temp;
    }

    public function setTemp(?string $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getAdw(): ?string
    {
        return $this->adw;
    }

    public function setAdw(?string $adw): self
    {
        $this->adw = $adw;

        return $this;
    }

    public function getGlary(): ?string
    {
        return $this->glary;
    }

    public function setGlary(?string $glary): self
    {
        $this->glary = $glary;

        return $this;
    }

    public function getMbm(): ?string
    {
        return $this->mbm;
    }

    public function setMbm(?string $mbm): self
    {
        $this->mbm = $mbm;

        return $this;
    }

    public function getTempPreftech(): ?string
    {
        return $this->temp_preftech;
    }

    public function setTempPreftech(?string $temp_preftech): self
    {
        $this->temp_preftech = $temp_preftech;

        return $this;
    }

    public function getObs1(): ?string
    {
        return $this->obs1;
    }

    public function setObs1(?string $obs1): self
    {
        $this->obs1 = $obs1;

        return $this;
    }

    public function getObs2(): ?string
    {
        return $this->obs2;
    }

    public function setObs2(?string $obs2): self
    {
        $this->obs2 = $obs2;

        return $this;
    }

    public function getTechnicien(): ?User
    {
        return $this->technicien;
    }

    public function setTechnicien(?User $technicien): self
    {
        $this->technicien = $technicien;

        return $this;
    }
}