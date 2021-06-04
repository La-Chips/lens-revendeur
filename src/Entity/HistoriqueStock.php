<?php

namespace App\Entity;

use App\Repository\HistoriqueStockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoriqueStockRepository::class)
 */
class HistoriqueStock
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
     * @ORM\Column(type="object")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="historiqueStocks")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modification;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

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

    public function getArticle()
    {
        return $this->article;
    }

    public function setArticle($article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getModification(): ?string
    {
        return $this->modification;
    }

    public function setModification(string $modification): self
    {
        $this->modification = $modification;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}