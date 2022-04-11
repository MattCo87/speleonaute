<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
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
     * @ORM\OneToMany(targetEntity=CreatureFormation::class, mappedBy="lienFormation")
     */
    private $creatureFormations;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="formations")
     */
    private $lienUser;

    /**
     * @ORM\OneToMany(targetEntity=Scenario::class, mappedBy="lienFormation")
     */
    private $scenarios;

    public function __construct()
    {
        $this->creatureFormations = new ArrayCollection();
        $this->scenarios = new ArrayCollection();
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
            $creatureFormation->setLienFormation($this);
        }

        return $this;
    }

    public function removeCreatureFormation(CreatureFormation $creatureFormation): self
    {
        if ($this->creatureFormations->removeElement($creatureFormation)) {
            // set the owning side to null (unless already changed)
            if ($creatureFormation->getLienFormation() === $this) {
                $creatureFormation->setLienFormation(null);
            }
        }

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

    /**
     * @return Collection<int, Scenario>
     */
    public function getScenarios(): Collection
    {
        return $this->scenarios;
    }

    public function addScenario(Scenario $scenario): self
    {
        if (!$this->scenarios->contains($scenario)) {
            $this->scenarios[] = $scenario;
            $scenario->setLienFormation($this);
        }

        return $this;
    }

    public function removeScenario(Scenario $scenario): self
    {
        if ($this->scenarios->removeElement($scenario)) {
            // set the owning side to null (unless already changed)
            if ($scenario->getLienFormation() === $this) {
                $scenario->setLienFormation(null);
            }
        }

        return $this;
    }
}
