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

    /**
     * @ORM\ManyToOne(targetEntity=Action::class, inversedBy="actionStrategies")
     */
    private $lienAction;

    /**
     * @ORM\ManyToOne(targetEntity=Strategie::class, inversedBy="actionStrategies")
     */
    private $lienStrategie;

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

    public function getLienAction(): ?Action
    {
        return $this->lienAction;
    }

    public function setLienAction(?Action $lienAction): self
    {
        $this->lienAction = $lienAction;

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
}
