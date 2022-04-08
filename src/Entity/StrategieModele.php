<?php

namespace App\Entity;

use App\Repository\StrategieModeleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StrategieModeleRepository::class)
 */
class StrategieModele
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
    private $positionStrategie;

    /**
     * @ORM\ManyToOne(targetEntity=Strategie::class, inversedBy="strategieModeles")
     */
    private $lienStrategie;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="strategieModeles")
     */
    private $lienModele;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPositionStrategie(): ?int
    {
        return $this->positionStrategie;
    }

    public function setPositionStrategie(int $positionStrategie): self
    {
        $this->positionStrategie = $positionStrategie;

        return $this;
    }

    public function getLienStrategie(): ?Strategie
    {
        return $this->lienStrategie;
    }

    public function setLienStrategie(?Strategie $lienStrategie): self
    {
        $this->lienStrategie = $lienStrategie;

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
}
