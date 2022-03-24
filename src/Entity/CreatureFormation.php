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
}
