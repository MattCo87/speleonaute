<?php

namespace App\Entity;

use App\Repository\CreatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreatureRepository::class)
 */
class Creature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $niveau;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $exp;

    /**
     * @ORM\OneToMany(targetEntity=StatistiqueCreature::class, mappedBy="lienCreature")
     */
    private $statistiqueCreatures;

    /**
     * @ORM\OneToMany(targetEntity=CreatureFormation::class, mappedBy="lienCreature")
     */
    private $creatureFormations;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="creatures")
     */
    private $lienModele;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="creatures", cascade={"persist"})
     */
    private $lienUser;

    public function __construct()
    {
        $this->statistiqueCreatures = new ArrayCollection();
        $this->creatureFormations = new ArrayCollection();
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

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(?int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getExp(): ?int
    {
        return $this->exp;
    }

    public function setExp(?int $exp): self
    {
        $this->exp = $exp;

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
            $statistiqueCreature->setLienCreature($this);
        }

        return $this;
    }

    public function removeStatistiqueCreature(StatistiqueCreature $statistiqueCreature): self
    {
        if ($this->statistiqueCreatures->removeElement($statistiqueCreature)) {
            // set the owning side to null (unless already changed)
            if ($statistiqueCreature->getLienCreature() === $this) {
                $statistiqueCreature->setLienCreature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CreatureFormation>
     */
    public function getCreatureFormations(): Collection
    {
        return $this->creatureFormations;
    }

    public function addCreatureFormation(CreatureFormation $creatureFormation): self
    {
        if (!$this->creatureFormations->contains($creatureFormation)) {
            $this->creatureFormations[] = $creatureFormation;
            $creatureFormation->setLienCreature($this);
        }

        return $this;
    }

    public function removeCreatureFormation(CreatureFormation $creatureFormation): self
    {
        if ($this->creatureFormations->removeElement($creatureFormation)) {
            // set the owning side to null (unless already changed)
            if ($creatureFormation->getLienCreature() === $this) {
                $creatureFormation->setLienCreature(null);
            }
        }

        return $this;
    }

    public function getLienModele(): ?Modele
    {
        return $this->lienModele;
    }

    public function setLienModele(?Modele $lienModele): self
    {
        $this->lienModele = $lienModele;

        return $this;
    }

    public function getLienUser(): ?User
    {
        return $this->lienUser;
    }

    public function setLienUser(?User $lienUser): self
    {
        $this->lienUser = $lienUser;

        return $this;
    }
}
