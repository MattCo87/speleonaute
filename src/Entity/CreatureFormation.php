<?php

namespace App\Entity;

use App\Repository\CreatureFormationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreatureFormationRepository::class)
 */
class CreatureFormation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $localisation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $strategie;

    /**
     * @ORM\ManyToOne(targetEntity=Creature::class, inversedBy="creatureFormations")
     */
    private $lienCreature;

    /**
     * @ORM\ManyToOne(targetEntity=Formation::class, inversedBy="creatureFormations")
     */
    private $lienFormation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalisation(): ?int
    {
        return $this->localisation;
    }

    public function setLocalisation(?int $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getStrategie(): ?int
    {
        return $this->strategie;
    }

    public function setStrategie(?int $strategie): self
    {
        $this->strategie = $strategie;

        return $this;
    }

    public function getLienCreature(): ?Creature
    {
        return $this->lienCreature;
    }

    public function setLienCreature(?Creature $lienCreature): self
    {
        $this->lienCreature = $lienCreature;

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
