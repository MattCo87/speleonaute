<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\ActionStrategie;

class ActionStrategieFixtures extends Fixture implements DependentFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getDependencies()
    {
        return [StrategieFixtures::class];
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $actStrat = new ActionStrategie();
        //dd($this->referenceRepository);
        // Méthodes propres à l'Entity
        $actStrat->setPositionAction(1)
            ->setLienAction($this->getReference("Mag3"))
            ->setLienStrategie($this->getReference("Tank1"));
        $manager->persist($actStrat);
        $manager->flush();
        // Ajoute l'objet pour les autres fichiers de fixtures
        $this->addReference("actStrat", $actStrat);
    }
}
