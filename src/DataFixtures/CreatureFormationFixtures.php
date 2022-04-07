<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use App\Entity\CreatureFormation;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CreatureFormationFixtures extends Fixture implements OrderedFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getOrder()
    {
        return 12;
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {

        $formationCreatures = array();
        // Create the entries
        $formationCreatures["FORMCREAT_1"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Milly", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_2"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Eccles", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_3"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Zabek", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_4"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Cradou", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_5"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Torti", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_6"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Rat sanguinaire 1", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_7"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Rat sanguinaire 2", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_8"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Rat sanguinaire 3", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_9"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Ver toxique 1", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_10"] = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Ver toxique 2", "localisation" => "", "strategie" => ""];

        foreach ($formationCreatures as $name => $formationCreature) {
            // Populate the objects
            $$name = new CreatureFormation();
            $$name->setLienFormation($this->getReference($formationCreature["lienFormation"]))
                ->setLienCreature($this->getReference($formationCreature["lienCreature"]))
                //->setLocalisation($formationCreature["localisation"])
                //->setStrategie($formationCreature["strategie"])
            ;
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
        $manager->flush();
    }
}
