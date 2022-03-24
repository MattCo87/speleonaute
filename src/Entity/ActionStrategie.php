<?php

namespace App\Entity;

use App\Repository\ActionStrategieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionStrategieRepository::class)
 */
class ActionStrategie
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
    private $positionAction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPositionAction(): ?int
    {
        return $this->positionAction;
    }

    public function setPositionAction(int $positionAction): self
    {
        $this->positionAction = $positionAction;

        return $this;
    }
}
