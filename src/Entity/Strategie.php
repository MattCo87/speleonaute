<?php

namespace App\Entity;

use App\Repository\StrategieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StrategieRepository::class)
 */
class Strategie
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
     * @ORM\OneToMany(targetEntity=ActionStrategie::class, mappedBy="lienStrategie")
     */
    private $actionStrategies;

    /**
     * @ORM\OneToMany(targetEntity=StrategieModele::class, mappedBy="lienStrategie")
     */
    private $strategieModeles;

    public function __construct()
    {
        $this->actionStrategies = new ArrayCollection();
        $this->strategieModeles = new ArrayCollection();
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

    /**
     * @return Collection<int, ActionStrategie>
     */
    public function getActionStrategies(): Collection
    {
        return $this->actionStrategies;
    }

    public function addActionStrategy(ActionStrategie $actionStrategy): self
    {
        if (!$this->actionStrategies->contains($actionStrategy)) {
            $this->actionStrategies[] = $actionStrategy;
            $actionStrategy->setLienStrategie($this);
        }

        return $this;
    }

    public function removeActionStrategy(ActionStrategie $actionStrategy): self
    {
        if ($this->actionStrategies->removeElement($actionStrategy)) {
            // set the owning side to null (unless already changed)
            if ($actionStrategy->getLienStrategie() === $this) {
                $actionStrategy->setLienStrategie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StrategieModele>
     */
    public function getStrategieModeles(): Collection
    {
        return $this->strategieModeles;
    }

    public function addStrategieModele(StrategieModele $strategieModele): self
    {
        if (!$this->strategieModeles->contains($strategieModele)) {
            $this->strategieModeles[] = $strategieModele;
            $strategieModele->setLienStrategie($this);
        }

        return $this;
    }

    public function removeStrategieModele(StrategieModele $strategieModele): self
    {
        if ($this->strategieModeles->removeElement($strategieModele)) {
            // set the owning side to null (unless already changed)
            if ($strategieModele->getLienStrategie() === $this) {
                $strategieModele->setLienStrategie(null);
            }
        }

        return $this;
    }
}
