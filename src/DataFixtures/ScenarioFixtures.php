<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use App\Entity\Scenario;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ScenarioFixtures extends Fixture implements OrderedFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getOrder()
    {
        return 13;
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $scenarios = array();
        // Create the entries
        $scenarios["SCENAR_nueenuisible"] = ["nom" => "nuée de nuisibles", "description" => "lorem ipsum", "recompense" => 15, "lienFormation" => "FORM_Nuisibles1"];
        $scenarios["SCENAR_embuscadetoxique"] = ["nom" => "embuscade toxique", "description" => "lorem ipsum", "recompense" => 20, "lienFormation" => "FORM_Venimeuse3"];
        $scenarios["SCENAR_tresordragon"] = ["nom" => "trésor du dragon", "description" => "lorem ipsum", "recompense" => 100, "lienFormation" => "FORM_Boss4"];

        foreach ($scenarios as $name => $scenario) {
            // Populate the objects
            $$name = new Scenario();
            $$name->setNom($scenario["nom"])
                ->setDescription($scenario["description"])
                ->setRecompense($scenario["recompense"])
                ->setLienFormation($this->getReference($scenario["lienFormation"]));
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
        $manager->flush();
    }
}
