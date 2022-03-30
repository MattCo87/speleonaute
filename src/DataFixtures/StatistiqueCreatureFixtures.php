<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\StatistiqueCreature;

class StatistiqueCreatureFixtures extends Fixture implements OrderedFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getOrder()
    {
        return 10;
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $statistiquesCreatures = array();
        // Create the entries
        $statistiquesCreatures["STRATCREAT_116"] = ["lienCreature" => "Milly21", "lienStatistique" => "STAT_touch", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_125"] = ["lienCreature" => "Milly21", "lienStatistique" => "STAT_degat", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_135"] = ["lienCreature" => "Milly21", "lienStatistique" => "STAT_resis", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_146"] = ["lienCreature" => "Milly21", "lienStatistique" => "STAT_vites", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_151"] = ["lienCreature" => "Milly21", "lienStatistique" => "STAT_endur", "valeur" => 18];
        $statistiquesCreatures["STRATCREAT_216"] = ["lienCreature" => "Eccles22", "lienStatistique" => "STAT_touch", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_227"] = ["lienCreature" => "Eccles22", "lienStatistique" => "STAT_degat", "valeur" => 7];
        $statistiquesCreatures["STRATCREAT_235"] = ["lienCreature" => "Eccles22", "lienStatistique" => "STAT_resis", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_243"] = ["lienCreature" => "Eccles22", "lienStatistique" => "STAT_vites", "valeur" => 3];
        $statistiquesCreatures["STRATCREAT_252"] = ["lienCreature" => "Eccles22", "lienStatistique" => "STAT_endur", "valeur" => 21];
        $statistiquesCreatures["STRATCREAT_315"] = ["lienCreature" => "Zabek23", "lienStatistique" => "STAT_touch", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_327"] = ["lienCreature" => "Zabek23", "lienStatistique" => "STAT_degat", "valeur" => 7];
        $statistiquesCreatures["STRATCREAT_336"] = ["lienCreature" => "Zabek23", "lienStatistique" => "STAT_resis", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_346"] = ["lienCreature" => "Zabek23", "lienStatistique" => "STAT_vites", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_351"] = ["lienCreature" => "Zabek23", "lienStatistique" => "STAT_endur", "valeur" => 13];
        $statistiquesCreatures["STRATCREAT_416"] = ["lienCreature" => "Cradou24", "lienStatistique" => "STAT_touch", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_427"] = ["lienCreature" => "Cradou24", "lienStatistique" => "STAT_degat", "valeur" => 7];
        $statistiquesCreatures["STRATCREAT_431"] = ["lienCreature" => "Cradou24", "lienStatistique" => "STAT_resis", "valeur" => 11];
        $statistiquesCreatures["STRATCREAT_443"] = ["lienCreature" => "Cradou24", "lienStatistique" => "STAT_vites", "valeur" => 3];
        $statistiquesCreatures["STRATCREAT_452"] = ["lienCreature" => "Cradou24", "lienStatistique" => "STAT_endur", "valeur" => 27];
        $statistiquesCreatures["STRATCREAT_518"] = ["lienCreature" => "Torti25", "lienStatistique" => "STAT_touch", "valeur" => 8];
        $statistiquesCreatures["STRATCREAT_521"] = ["lienCreature" => "Torti25", "lienStatistique" => "STAT_degat", "valeur" => 11];
        $statistiquesCreatures["STRATCREAT_539"] = ["lienCreature" => "Torti25", "lienStatistique" => "STAT_resis", "valeur" => 9];
        $statistiquesCreatures["STRATCREAT_541"] = ["lienCreature" => "Torti25", "lienStatistique" => "STAT_vites", "valeur" => 10];
        $statistiquesCreatures["STRATCREAT_552"] = ["lienCreature" => "Torti25", "lienStatistique" => "STAT_endur", "valeur" => 25];
        $statistiquesCreatures["STRATCREAT_614"] = ["lienCreature" => "Rat sanguinaire16", "lienStatistique" => "STAT_touch", "valeur" => 4];
        $statistiquesCreatures["STRATCREAT_625"] = ["lienCreature" => "Rat sanguinaire16", "lienStatistique" => "STAT_degat", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_633"] = ["lienCreature" => "Rat sanguinaire16", "lienStatistique" => "STAT_resis", "valeur" => 3];
        $statistiquesCreatures["STRATCREAT_649"] = ["lienCreature" => "Rat sanguinaire16", "lienStatistique" => "STAT_vites", "valeur" => 9];
        $statistiquesCreatures["STRATCREAT_651"] = ["lienCreature" => "Rat sanguinaire16", "lienStatistique" => "STAT_endur", "valeur" => 17];
        $statistiquesCreatures["STRATCREAT_716"] = ["lienCreature" => "Ver toxique17", "lienStatistique" => "STAT_touch", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_726"] = ["lienCreature" => "Ver toxique17", "lienStatistique" => "STAT_degat", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_735"] = ["lienCreature" => "Ver toxique17", "lienStatistique" => "STAT_resis", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_744"] = ["lienCreature" => "Ver toxique17", "lienStatistique" => "STAT_vites", "valeur" => 4];
        $statistiquesCreatures["STRATCREAT_751"] = ["lienCreature" => "Ver toxique17", "lienStatistique" => "STAT_endur", "valeur" => 15];

        foreach ($statistiquesCreatures as $name => $statistiqueCreature) {
            // Populate the objects
            $$name = new StatistiqueCreature();
            $$name->setLienCreature($this->getReference($statistiqueCreature["lienCreature"]))
                ->setLienStatistique($this->getReference($statistiqueCreature["lienStatistique"]))
                ->setValeur($statistiqueCreature["valeur"]);
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
        $manager->flush();
    }
}
