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
        return 6;
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $formationCreatures = array();
        // Create the entries
        $formationCreatures["FORMCREAT_1"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Milly21", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_2"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Eccles22", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_3"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Zabek23", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_4"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Cradou24", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_5"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Torti25", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_6"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Rat sanguinaire16", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_7"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Rat sanguinaire16", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_8"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Rat sanguinaire16", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_9"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Ver toxique17", "localisation" => "", "strategie" => ""];
        $formationCreatures["FORMCREAT_10"] = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Ver toxique17", "localisation" => "", "strategie" => ""];

        foreach ($formationCreatures as $name => $formationCreature) {
            // Populate the objects
            $$name = new CreatureFormation();
            $$name->setLienFormation($this->getReference($formationCreature["lienFormation"]))
                ->setLienCreature($this->getReference($formationCreature["lienCreature"]))
                ->setLocalisation($formationCreature["localisation"])
                ->setStrategie($formationCreature["strategie"]);
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
        $manager->flush();
    }
}
