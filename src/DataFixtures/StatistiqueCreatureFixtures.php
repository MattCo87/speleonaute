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
        $statistiquesCreatures["STRATCREAT_Milly 116"] = ["lienCreature" => "Milly", "lienStatistique" => "STAT_touch", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Milly 125"] = ["lienCreature" => "Milly", "lienStatistique" => "STAT_degat", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_Milly 135"] = ["lienCreature" => "Milly", "lienStatistique" => "STAT_resis", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_Milly 146"] = ["lienCreature" => "Milly", "lienStatistique" => "STAT_vites", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Milly 151"] = ["lienCreature" => "Milly", "lienStatistique" => "STAT_endur", "valeur" => 18];
        $statistiquesCreatures["STRATCREAT_Eccle 216"] = ["lienCreature" => "Eccles", "lienStatistique" => "STAT_touch", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Eccle 227"] = ["lienCreature" => "Eccles", "lienStatistique" => "STAT_degat", "valeur" => 7];
        $statistiquesCreatures["STRATCREAT_Eccle 235"] = ["lienCreature" => "Eccles", "lienStatistique" => "STAT_resis", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_Eccle 243"] = ["lienCreature" => "Eccles", "lienStatistique" => "STAT_vites", "valeur" => 3];
        $statistiquesCreatures["STRATCREAT_Eccle 252"] = ["lienCreature" => "Eccles", "lienStatistique" => "STAT_endur", "valeur" => 21];
        $statistiquesCreatures["STRATCREAT_Zabek 315"] = ["lienCreature" => "Zabek", "lienStatistique" => "STAT_touch", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_Zabek 327"] = ["lienCreature" => "Zabek", "lienStatistique" => "STAT_degat", "valeur" => 7];
        $statistiquesCreatures["STRATCREAT_Zabek 336"] = ["lienCreature" => "Zabek", "lienStatistique" => "STAT_resis", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Zabek 346"] = ["lienCreature" => "Zabek", "lienStatistique" => "STAT_vites", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Zabek 351"] = ["lienCreature" => "Zabek", "lienStatistique" => "STAT_endur", "valeur" => 13];
        $statistiquesCreatures["STRATCREAT_Crado 416"] = ["lienCreature" => "Cradou", "lienStatistique" => "STAT_touch", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Crado 427"] = ["lienCreature" => "Cradou", "lienStatistique" => "STAT_degat", "valeur" => 7];
        $statistiquesCreatures["STRATCREAT_Crado 431"] = ["lienCreature" => "Cradou", "lienStatistique" => "STAT_resis", "valeur" => 11];
        $statistiquesCreatures["STRATCREAT_Crado 443"] = ["lienCreature" => "Cradou", "lienStatistique" => "STAT_vites", "valeur" => 3];
        $statistiquesCreatures["STRATCREAT_Crado 452"] = ["lienCreature" => "Cradou", "lienStatistique" => "STAT_endur", "valeur" => 27];
        $statistiquesCreatures["STRATCREAT_Torti 518"] = ["lienCreature" => "Torti", "lienStatistique" => "STAT_touch", "valeur" => 8];
        $statistiquesCreatures["STRATCREAT_Torti 521"] = ["lienCreature" => "Torti", "lienStatistique" => "STAT_degat", "valeur" => 11];
        $statistiquesCreatures["STRATCREAT_Torti 539"] = ["lienCreature" => "Torti", "lienStatistique" => "STAT_resis", "valeur" => 9];
        $statistiquesCreatures["STRATCREAT_Torti 541"] = ["lienCreature" => "Torti", "lienStatistique" => "STAT_vites", "valeur" => 10];
        $statistiquesCreatures["STRATCREAT_Torti 552"] = ["lienCreature" => "Torti", "lienStatistique" => "STAT_endur", "valeur" => 25];
        $statistiquesCreatures["STRATCREAT_Rat s 614"] = ["lienCreature" => "Rat sanguinaire 1", "lienStatistique" => "STAT_touch", "valeur" => 4];
        $statistiquesCreatures["STRATCREAT_Rat s 625"] = ["lienCreature" => "Rat sanguinaire 1", "lienStatistique" => "STAT_degat", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_Rat s 633"] = ["lienCreature" => "Rat sanguinaire 1", "lienStatistique" => "STAT_resis", "valeur" => 3];
        $statistiquesCreatures["STRATCREAT_Rat s 649"] = ["lienCreature" => "Rat sanguinaire 1", "lienStatistique" => "STAT_vites", "valeur" => 9];
        $statistiquesCreatures["STRATCREAT_Rat s 651"] = ["lienCreature" => "Rat sanguinaire 1", "lienStatistique" => "STAT_endur", "valeur" => 17];
        $statistiquesCreatures["STRATCREAT_Rat s 714"] = ["lienCreature" => "Rat sanguinaire 2", "lienStatistique" => "STAT_touch", "valeur" => 4];
        $statistiquesCreatures["STRATCREAT_Rat s 725"] = ["lienCreature" => "Rat sanguinaire 2", "lienStatistique" => "STAT_degat", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_Rat s 733"] = ["lienCreature" => "Rat sanguinaire 2", "lienStatistique" => "STAT_resis", "valeur" => 3];
        $statistiquesCreatures["STRATCREAT_Rat s 749"] = ["lienCreature" => "Rat sanguinaire 2", "lienStatistique" => "STAT_vites", "valeur" => 9];
        $statistiquesCreatures["STRATCREAT_Rat s 751"] = ["lienCreature" => "Rat sanguinaire 2", "lienStatistique" => "STAT_endur", "valeur" => 17];
        $statistiquesCreatures["STRATCREAT_Rat s 814"] = ["lienCreature" => "Rat sanguinaire 3", "lienStatistique" => "STAT_touch", "valeur" => 4];
        $statistiquesCreatures["STRATCREAT_Rat s 825"] = ["lienCreature" => "Rat sanguinaire 3", "lienStatistique" => "STAT_degat", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_Rat s 833"] = ["lienCreature" => "Rat sanguinaire 3", "lienStatistique" => "STAT_resis", "valeur" => 3];
        $statistiquesCreatures["STRATCREAT_Rat s 849"] = ["lienCreature" => "Rat sanguinaire 3", "lienStatistique" => "STAT_vites", "valeur" => 9];
        $statistiquesCreatures["STRATCREAT_Rat s 851"] = ["lienCreature" => "Rat sanguinaire 3", "lienStatistique" => "STAT_endur", "valeur" => 17];
        $statistiquesCreatures["STRATCREAT_Ver t 916"] = ["lienCreature" => "Ver toxique 1", "lienStatistique" => "STAT_touch", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Ver t 926"] = ["lienCreature" => "Ver toxique 1", "lienStatistique" => "STAT_degat", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Ver t 935"] = ["lienCreature" => "Ver toxique 1", "lienStatistique" => "STAT_resis", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_Ver t 944"] = ["lienCreature" => "Ver toxique 1", "lienStatistique" => "STAT_vites", "valeur" => 4];
        $statistiquesCreatures["STRATCREAT_Ver t 951"] = ["lienCreature" => "Ver toxique 1", "lienStatistique" => "STAT_endur", "valeur" => 15];
        $statistiquesCreatures["STRATCREAT_Ver t 101"] = ["lienCreature" => "Ver toxique 2", "lienStatistique" => "STAT_touch", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Ver t 102"] = ["lienCreature" => "Ver toxique 2", "lienStatistique" => "STAT_degat", "valeur" => 6];
        $statistiquesCreatures["STRATCREAT_Ver t 103"] = ["lienCreature" => "Ver toxique 2", "lienStatistique" => "STAT_resis", "valeur" => 5];
        $statistiquesCreatures["STRATCREAT_Ver t 104"] = ["lienCreature" => "Ver toxique 2", "lienStatistique" => "STAT_vites", "valeur" => 4];
        $statistiquesCreatures["STRATCREAT_Ver t 105"] = ["lienCreature" => "Ver toxique 2", "lienStatistique" => "STAT_endur", "valeur" => 15];

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
