<?php

namespace App\Entity;

use App\Repository\ScenarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScenarioRepository::class)
 */
class Scenario
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $recompense;

    /**
     * @ORM\OneToMany(targetEntity=Combat::class, mappedBy="lienScenario")
     */
    private $combats;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="scenarios")
     */
    private $lienFormation;

    public function __construct()
    {
        $this->combats = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRecompense(): ?int
    {
        return $this->recompense;
    }

    public function setRecompense(int $recompense): self
    {
        $this->recompense = $recompense;

        return $this;
    }

    /**
     * @return Collection<int, Combat>
     */
    public function getCombats(): Collection
    {
        return $this->combats;
    }

    public function addCombat(Combat $combat): self
    {
        if (!$this->combats->contains($combat)) {
            $this->combats[] = $combat;
            $combat->setLienScenario($this);
        }

        return $this;
    }

    public function removeCombat(Combat $combat): self
    {
        if ($this->combats->removeElement($combat)) {
            // set the owning side to null (unless already changed)
            if ($combat->getLienScenario() === $this) {
                $combat->setLienScenario(null);
            }
        }

        return $this;
    }

    public function getLienFormation(): ?Formation
    {
        return $this->lienFormation;
    }

    public function setLienFormation(?Formation $lienFormation): self
    {
        $this->lienFormation = $lienFormation;

        return $this;
    }
}
