<?php

namespace App\Entity;

use App\Repository\CombatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CombatRepository::class)
 */
class Combat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCombat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fichierLog;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="combats")
     */
    private $lienUser;

    /**
     * @ORM\ManyToOne(targetEntity=Scenario::class, inversedBy="combats")
     */
    private $lienScenario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCombat(): ?\DateTimeInterface
    {
        return $this->dateCombat;
    }

    public function setDateCombat(\DateTimeInterface $dateCombat): self
    {
        $this->dateCombat = $dateCombat;

        return $this;
    }

    public function getFichierLog(): ?string
    {
        return $this->fichierLog;
    }

    public function setFichierLog(string $fichierLog): self
    {
        $this->fichierLog = $fichierLog;

        return $this;
    }

    public function getLienUser(): ?User
    {
        return $this->lienUser;
    }

    public function setLienUser(?User $lienUser): self
    {
        $this->lienUser = $lienUser;

        return $this;
    }

    public function getLienScenario(): ?Scenario
    {
        return $this->lienScenario;
    }

    public function setLienScenario(?Scenario $lienScenario): self
    {
        $this->lienScenario = $lienScenario;

        return $this;
    }
}
