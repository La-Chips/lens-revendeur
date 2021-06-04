<?php

namespace App\Entity;

use App\Repository\DisqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DisqueRepository::class)
 */
class Disque
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
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $capacity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recover;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $backup;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $state_value;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
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

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(?string $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getRecover(): ?string
    {
        return $this->recover;
    }

    public function setRecover(?string $recover): self
    {
        $this->recover = $recover;

        return $this;
    }

    public function getBackup(): ?string
    {
        return $this->backup;
    }

    public function setBackup(?string $backup): self
    {
        $this->backup = $backup;

        return $this;
    }

    public function getStateValue(): ?string
    {
        return $this->state_value;
    }

    public function setStateValue(?string $state_value): self
    {
        $this->state_value = $state_value;

        return $this;
    }
}