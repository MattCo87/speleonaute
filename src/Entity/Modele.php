<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
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
}
