<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Action;

class Fixtures_Model extends Fixture implements DependentFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getDependencies()
    {
        return [UserFixtures::class];
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $test = new Action();
        // Méthodes propres à l'Entity
        $test->setNom("Action pour tester les fixtures")
            ->setToucher(1)
            ->setDegat(1)
            ->setTier(1);
        $manager->persist($test);
        $manager->flush();
        // Ajoute l'objet pour les autres fichiers de fixtures
        $this->addReference("Test_de_fixture", $test);
    }
}
