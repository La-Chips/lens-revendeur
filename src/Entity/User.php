<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Sav::class, mappedBy="Technicien", orphanRemoval=true)
     */
    private $savs;

    /**
     * @ORM\OneToMany(targetEntity=Etapes::class, mappedBy="technicien")
     */
    private $etapes;

    /**
     * @ORM\OneToMany(targetEntity=Diagnostic::class, mappedBy="technicien")
     */
    private $diagnostics;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueStock::class, mappedBy="user")
     */
    private $historiqueStocks;

    public function __construct()
    {
        $this->savs = new ArrayCollection();
        $this->etapes = new ArrayCollection();
        $this->diagnostics = new ArrayCollection();
        $this->historiqueStocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $username = strtolower($username);
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $sav->setTechnicien($this);
        }

        return $this;
    }

    public function removeSav(Sav $sav): self
    {
        if ($this->savs->removeElement($sav)) {
            // set the owning side to null (unless already changed)
            if ($sav->getTechnicien() === $this) {
                $sav->setTechnicien(null);
            }
        }

        return $this;
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
            $etape->setTechnicien($this);
        }

        return $this;
    }

    public function removeEtape(Etapes $etape): self
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getTechnicien() === $this) {
                $etape->setTechnicien(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Diagnostic[]
     */
    public function getDiagnostics(): Collection
    {
        return $this->diagnostics;
    }

    public function addDiagnostic(Diagnostic $diagnostic): self
    {
        if (!$this->diagnostics->contains($diagnostic)) {
            $this->diagnostics[] = $diagnostic;
            $diagnostic->setTechnicien($this);
        }

        return $this;
    }

    public function removeDiagnostic(Diagnostic $diagnostic): self
    {
        if ($this->diagnostics->removeElement($diagnostic)) {
            // set the owning side to null (unless already changed)
            if ($diagnostic->getTechnicien() === $this) {
                $diagnostic->setTechnicien(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }

    /**
     * @return Collection|HistoriqueStock[]
     */
    public function getHistoriqueStocks(): Collection
    {
        return $this->historiqueStocks;
    }

    public function addHistoriqueStock(HistoriqueStock $historiqueStock): self
    {
        if (!$this->historiqueStocks->contains($historiqueStock)) {
            $this->historiqueStocks[] = $historiqueStock;
            $historiqueStock->setUser($this);
        }

        return $this;
    }

    public function removeHistoriqueStock(HistoriqueStock $historiqueStock): self
    {
        if ($this->historiqueStocks->removeElement($historiqueStock)) {
            // set the owning side to null (unless already changed)
            if ($historiqueStock->getUser() === $this) {
                $historiqueStock->setUser(null);
            }
        }

        return $this;
    }
}