<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModeleRepository::class)
 */
class Modele
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
    private $nomModele;

    /**
     * @ORM\Column(type="integer")
     */
    private $rarete;

    /**
     * @ORM\Column(type="integer")
     */
    private $pointNiv;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ouvrable;

    /**
     * @ORM\OneToMany(targetEntity=StrategieModele::class, mappedBy="lienModele")
     */
    private $strategieModeles;

    /**
     * @ORM\OneToMany(targetEntity=StatistiqueModele::class, mappedBy="lienModele")
     */
    private $statistiqueModeles;

    /**
     * @ORM\OneToMany(targetEntity=Creature::class, mappedBy="lienModele")
     */
    private $creatures;

    public function __construct()
    {
        $this->strategieModeles = new ArrayCollection();
        $this->statistiqueModeles = new ArrayCollection();
        $this->creatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomModele(): ?string
    {
        return $this->nomModele;
    }

    public function setNomModele(string $nomModele): self
    {
        $this->nomModele = $nomModele;

        return $this;
    }

    public function getRarete(): ?int
    {
        return $this->rarete;
    }

    public function setRarete(int $rarete): self
    {
        $this->rarete = $rarete;

        return $this;
    }

    public function getPointNiv(): ?int
    {
        return $this->pointNiv;
    }

    public function setPointNiv(int $pointNiv): self
    {
        $this->pointNiv = $pointNiv;

        return $this;
    }

    public function getOuvrable(): ?bool
    {
        return $this->ouvrable;
    }

    public function setOuvrable(bool $ouvrable): self
    {
        $this->ouvrable = $ouvrable;

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
            $strategieModele->setLienModele($this);
        }

        return $this;
    }

    public function removeStrategieModele(StrategieModele $strategieModele): self
    {
        if ($this->strategieModeles->removeElement($strategieModele)) {
            // set the owning side to null (unless already changed)
            if ($strategieModele->getLienModele() === $this) {
                $strategieModele->setLienModele(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StatistiqueModele>
     */
    public function getStatistiqueModeles(): Collection
    {
        return $this->statistiqueModeles;
    }

    public function addStatistiqueModele(StatistiqueModele $statistiqueModele): self
    {
        if (!$this->statistiqueModeles->contains($statistiqueModele)) {
            $this->statistiqueModeles[] = $statistiqueModele;
            $statistiqueModele->setLienModele($this);
        }

        return $this;
    }

    public function removeStatistiqueModele(StatistiqueModele $statistiqueModele): self
    {
        if ($this->statistiqueModeles->removeElement($statistiqueModele)) {
            // set the owning side to null (unless already changed)
            if ($statistiqueModele->getLienModele() === $this) {
                $statistiqueModele->setLienModele(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Creature>
     */
    public function getCreatures(): Collection
    {
        return $this->creatures;
    }

    public function addCreature(Creature $creature): self
    {
        if (!$this->creatures->contains($creature)) {
            $this->creatures[] = $creature;
            $creature->setLienModele($this);
        }

        return $this;
    }

    public function removeCreature(Creature $creature): self
    {
        if ($this->creatures->removeElement($creature)) {
            // set the owning side to null (unless already changed)
            if ($creature->getLienModele() === $this) {
                $creature->setLienModele(null);
            }
        }

        return $this;
    }
}
