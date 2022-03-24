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
}
