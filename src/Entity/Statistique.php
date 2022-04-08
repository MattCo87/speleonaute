<?php

namespace App\Entity;

use App\Repository\StatistiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatistiqueRepository::class)
 */
class Statistique
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
     * @ORM\OneToMany(targetEntity=StatistiqueModele::class, mappedBy="lienStatistique")
     */
    private $statistiqueModeles;

    /**
     * @ORM\OneToMany(targetEntity=StatistiqueCreature::class, mappedBy="lienStatistique")
     */
    private $statistiqueCreatures;

    public function __construct()
    {
        $this->statistiqueModeles = new ArrayCollection();
        $this->statistiqueCreatures = new ArrayCollection();
    }

        /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getNom();
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
            $statistiqueModele->setLienStatistique($this);
        }

        return $this;
    }

    public function removeStatistiqueModele(StatistiqueModele $statistiqueModele): self
    {
        if ($this->statistiqueModeles->removeElement($statistiqueModele)) {
            // set the owning side to null (unless already changed)
            if ($statistiqueModele->getLienStatistique() === $this) {
                $statistiqueModele->setLienStatistique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StatistiqueCreature>
     */
    public function getStatistiqueCreatures(): Collection
    {
        return $this->statistiqueCreatures;
    }

    public function addStatistiqueCreature(StatistiqueCreature $statistiqueCreature): self
    {
        if (!$this->statistiqueCreatures->contains($statistiqueCreature)) {
            $this->statistiqueCreatures[] = $statistiqueCreature;
            $statistiqueCreature->setLienStatistique($this);
        }

        return $this;
    }

    public function removeStatistiqueCreature(StatistiqueCreature $statistiqueCreature): self
    {
        if ($this->statistiqueCreatures->removeElement($statistiqueCreature)) {
            // set the owning side to null (unless already changed)
            if ($statistiqueCreature->getLienStatistique() === $this) {
                $statistiqueCreature->setLienStatistique(null);
            }
        }

        return $this;
    }
}
