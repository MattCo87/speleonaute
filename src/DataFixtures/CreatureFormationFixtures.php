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
        $formationCreatures["FORMCREAT_1"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Milly", "localisation" => "1", "strategie" => "1"];
        $formationCreatures["FORMCREAT_2"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Eccles", "localisation" => "1", "strategie" => "1"];
        $formationCreatures["FORMCREAT_3"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Zabek", "localisation" => "2", "strategie" => "1"];
        $formationCreatures["FORMCREAT_4"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Cradou", "localisation" => "2", "strategie" => "1"];
        $formationCreatures["FORMCREAT_5"]  = ["lienFormation" => "FORM_DreamTeam2", "lienCreature" => "Torti", "localisation" => "3", "strategie" => "1"];
        $formationCreatures["FORMCREAT_6"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Rat sanguinaire 1", "localisation" => "1", "strategie" => "1"];
        $formationCreatures["FORMCREAT_7"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Rat sanguinaire 2", "localisation" => "2", "strategie" => "1"];
        $formationCreatures["FORMCREAT_8"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Rat sanguinaire 3", "localisation" => "3", "strategie" => "1"];
        $formationCreatures["FORMCREAT_9"]  = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Ver toxique 1", "localisation" => "3", "strategie" => "1"];
        $formationCreatures["FORMCREAT_10"] = ["lienFormation" => "FORM_Nuisibles1", "lienCreature" => "Ver toxique 2", "localisation" => "3", "strategie" => "1"];
        $formationCreatures["FORMCREAT_11"] = ["lienFormation" => "FORM_Venimeuse3", "lienCreature" => "Guepe venimeuse geante 1", "localisation" => "1", "strategie" => "1"];
        $formationCreatures["FORMCREAT_12"] = ["lienFormation" => "FORM_Venimeuse3", "lienCreature" => "Guepe venimeuse geante 2", "localisation" => "1", "strategie" => "1"];
        $formationCreatures["FORMCREAT_13"] = ["lienFormation" => "FORM_Venimeuse3", "lienCreature" => "Guepe venimeuse geante 3", "localisation" => "1", "strategie" => "1"];
        $formationCreatures["FORMCREAT_14"] = ["lienFormation" => "FORM_Venimeuse3", "lienCreature" => "Ver toxique 1", "localisation" => "2", "strategie" => "1"];
        $formationCreatures["FORMCREAT_15"] = ["lienFormation" => "FORM_Venimeuse3", "lienCreature" => "Ver toxique 2", "localisation" => "3", "strategie" => "1"];
        $formationCreatures["FORMCREAT_16"] = ["lienFormation" => "FORM_Boss4", "lienCreature" => "Dragon blanc au yeux bleu", "localisation" => "1", "strategie" => "1"];

        foreach ($formationCreatures as $name => $formationCreature) {
            // Populate the objects
            $$name = new CreatureFormation();
            $$name->setLienFormation($this->getReference($formationCreature["lienFormation"]))
                ->setLienCreature($this->getReference($formationCreature["lienCreature"]))
                ->setLocalisation($formationCreature["localisation"])
                ->setStrategie($formationCreature["strategie"])
            ;
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
        $manager->flush();
    }
}
