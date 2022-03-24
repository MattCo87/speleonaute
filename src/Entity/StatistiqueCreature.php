<?php

namespace App\Entity;

use App\Repository\StatistiqueCreatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatistiqueCreatureRepository::class)
 */
class StatistiqueCreature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeur;

    /**
     * @ORM\ManyToOne(targetEntity=Creature::class, inversedBy="statistiqueCreatures")
     */
    private $lienCreature;

    /**
     * @ORM\ManyToOne(targetEntity=Statistique::class, inversedBy="statistiqueCreatures")
     */
    private $lienStatistique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

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

    public function getLienStatistique(): ?Statistique
    {
        return $this->lienStatistique;
    }

    public function setLienStatistique(?Statistique $lienStatistique): self
    {
        $this->lienStatistique = $lienStatistique;

        return $this;
    }
}
