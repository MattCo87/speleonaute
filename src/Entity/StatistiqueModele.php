<?php

namespace App\Entity;

use App\Repository\StatistiqueModeleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatistiqueModeleRepository::class)
 */
class StatistiqueModele
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
    private $valeurMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeurMax;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeurNiv;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="statistiqueModeles")
     */
    private $lienModele;

    /**
     * @ORM\ManyToOne(targetEntity=Statistique::class, inversedBy="statistiqueModeles")
     */
    private $lienStatistique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeurMin(): ?int
    {
        return $this->valeurMin;
    }

    public function setValeurMin(int $valeurMin): self
    {
        $this->valeurMin = $valeurMin;

        return $this;
    }

    public function getValeurMax(): ?int
    {
        return $this->valeurMax;
    }

    public function setValeurMax(int $valeurMax): self
    {
        $this->valeurMax = $valeurMax;

        return $this;
    }

    public function getValeurNiv(): ?int
    {
        return $this->valeurNiv;
    }

    public function setValeurNiv(int $valeurNiv): self
    {
        $this->valeurNiv = $valeurNiv;

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
