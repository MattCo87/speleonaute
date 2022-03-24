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
}
