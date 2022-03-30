<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 * @ORM\Table(name="`action`")
 */
class Action
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
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $toucher;

    /**
     * @ORM\Column(type="integer")
     */
    private $degat;

    /**
     * @ORM\Column(type="integer")
     */
    private $tier;

    /**
     * @ORM\OneToMany(targetEntity=ActionStrategie::class, mappedBy="lienAction")
     */
    private $actionStrategies;

    public function __construct()
    {
        $this->actionStrategies = new ArrayCollection();
    }

        /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getNom();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getToucher(): ?int
    {
        return $this->toucher;
    }

    public function setToucher(int $toucher): self
    {
        $this->toucher = $toucher;

        return $this;
    }

    public function getDegat(): ?int
    {
        return $this->degat;
    }

    public function setDegat(int $degat): self
    {
        $this->degat = $degat;

        return $this;
    }

    public function getTier(): ?int
    {
        return $this->tier;
    }

    public function setTier(int $tier): self
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * @return Collection<int, ActionStrategie>
     */
    public function getActionStrategies(): Collection
    {
        return $this->actionStrategies;
    }

    public function addActionStrategy(ActionStrategie $actionStrategy): self
    {
        if (!$this->actionStrategies->contains($actionStrategy)) {
            $this->actionStrategies[] = $actionStrategy;
            $actionStrategy->setLienAction($this);
        }

        return $this;
    }

    public function removeActionStrategy(ActionStrategie $actionStrategy): self
    {
        if ($this->actionStrategies->removeElement($actionStrategy)) {
            // set the owning side to null (unless already changed)
            if ($actionStrategy->getLienAction() === $this) {
                $actionStrategy->setLienAction(null);
            }
        }

        return $this;
    }
}
