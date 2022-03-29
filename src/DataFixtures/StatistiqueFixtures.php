<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use App\Entity\Statistique;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class StatistiqueFixtures extends Fixture implements OrderedFixtureInterface
{

    public function getOrder()
    {
        return 7;
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $stratistiques = array();
        // Create the entries
        $statistiques["STAT_touch"] = ["name" => "toucher"];
        $statistiques["STAT_degat"] = ["name" => "degat"];
        $statistiques["STAT_resis"] = ["name" => "resistance"];
        $statistiques["STAT_vites"] = ["name" => "vitesse"];
        $statistiques["STAT_endur"] = ["name" => "endurance"];

        foreach ($stratistiques as $name => $statistique) {
            // Populate the objects
            $$name = new Statistique();
            $$name->setNom($statistique["nom"]);
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
    }
}
