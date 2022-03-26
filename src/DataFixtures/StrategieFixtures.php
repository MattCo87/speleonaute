<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Strategie;

class StrategieFixtures extends Fixture implements DependentFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getDependencies()
    {
        return [ActionFixtures::class];
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $strategies = array();
        for ($i = 1; $i < 4; $i++) {
            // Create the entries
            $strategies["Tank" . $i] = ["nom" => "Un joueur Tank version $i"];
            $strategies["Snipe" . $i] = ["nom" => "Sniper de l'arrière version $i"];
            $strategies["Speed" . $i] = ["nom" => "Prendre de vitesse version $i"];
            $strategies["Defense" . $i] = ["nom" => "Pure défense version $i"];
        }
        foreach ($strategies as $name => $strategy) {
            // Populate the objects
            $$name = new Strategie();
            $$name->setNom($strategy["nom"]);
            $manager->persist($$name);
            $manager->flush();
            $this->addReference($name, $$name);
            dump($name);
            dump($$name);
        }
    }
}
