<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use App\Entity\StatistiqueModele;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class StatistiqueModeleFixture extends Fixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 8;
    }

    public function load(ObjectManager $manager): void
    {

        $statistiquesModele = array();

        // Create the entries
        $statistiquesModele["STATMOD_1147"] = ["lienModele" => "MODEL_Araignedes", "lienStatistique" => "STAT_touch", "valeurMin" => 4, "valeurMax" => 7, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_1236"] = ["lienModele" => "MODEL_Araignedes", "lienStatistique" => "STAT_degat", "valeurMin" => 3, "valeurMax" => 6, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_1335"] = ["lienModele" => "MODEL_Araignedes", "lienStatistique" => "STAT_resis", "valeurMin" => 3, "valeurMax" => 5, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_1468"] = ["lienModele" => "MODEL_Araignedes", "lienStatistique" => "STAT_vites", "valeurMin" => 6, "valeurMax" => 8, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_1515"] = ["lienModele" => "MODEL_Araignedes", "lienStatistique" => "STAT_endur", "valeurMin" => 15, "valeurMax" => 20, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_2157"] = ["lienModele" => "MODEL_VerPsychiq", "lienStatistique" => "STAT_touch", "valeurMin" => 5, "valeurMax" => 7, "valeurNiv" => 11];
        $statistiquesModele["STATMOD_2247"] = ["lienModele" => "MODEL_VerPsychiq", "lienStatistique" => "STAT_degat", "valeurMin" => 4, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_2336"] = ["lienModele" => "MODEL_VerPsychiq", "lienStatistique" => "STAT_resis", "valeurMin" => 3, "valeurMax" => 6, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_2434"] = ["lienModele" => "MODEL_VerPsychiq", "lienStatistique" => "STAT_vites", "valeurMin" => 3, "valeurMax" => 4, "valeurNiv" => 3];
        $statistiquesModele["STATMOD_2518"] = ["lienModele" => "MODEL_VerPsychiq", "lienStatistique" => "STAT_endur", "valeurMin" => 18, "valeurMax" => 23, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_3137"] = ["lienModele" => "MODEL_Rejetonde",  "lienStatistique" => "STAT_touch", "valeurMin" => 3, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_3237"] = ["lienModele" => "MODEL_Rejetonde",  "lienStatistique" => "STAT_degat", "valeurMin" => 3, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_3337"] = ["lienModele" => "MODEL_Rejetonde",  "lienStatistique" => "STAT_resis", "valeurMin" => 3, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_3468"] = ["lienModele" => "MODEL_Rejetonde",  "lienStatistique" => "STAT_vites", "valeurMin" => 6, "valeurMax" => 8, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_3510"] = ["lienModele" => "MODEL_Rejetonde",  "lienStatistique" => "STAT_endur", "valeurMin" => 10, "valeurMax" => 25, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_4148"] = ["lienModele" => "MODEL_Cubegelati", "lienStatistique" => "STAT_touch", "valeurMin" => 4, "valeurMax" => 8, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_4269"] = ["lienModele" => "MODEL_Cubegelati", "lienStatistique" => "STAT_degat", "valeurMin" => 6, "valeurMax" => 9, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_4381"] = ["lienModele" => "MODEL_Cubegelati", "lienStatistique" => "STAT_resis", "valeurMin" => 8, "valeurMax" => 12, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_4434"] = ["lienModele" => "MODEL_Cubegelati", "lienStatistique" => "STAT_vites", "valeurMin" => 3, "valeurMax" => 4, "valeurNiv" => 2];
        $statistiquesModele["STATMOD_4520"] = ["lienModele" => "MODEL_Cubegelati", "lienStatistique" => "STAT_endur", "valeurMin" => 20, "valeurMax" => 30, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_5181"] = ["lienModele" => "MODEL_Basilicgea", "lienStatistique" => "STAT_touch", "valeurMin" => 8, "valeurMax" => 10, "valeurNiv" => 11];
        $statistiquesModele["STATMOD_5271"] = ["lienModele" => "MODEL_Basilicgea", "lienStatistique" => "STAT_degat", "valeurMin" => 7, "valeurMax" => 11, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_5371"] = ["lienModele" => "MODEL_Basilicgea", "lienStatistique" => "STAT_resis", "valeurMin" => 7, "valeurMax" => 10, "valeurNiv" => 7];
        $statistiquesModele["STATMOD_5461"] = ["lienModele" => "MODEL_Basilicgea", "lienStatistique" => "STAT_vites", "valeurMin" => 6, "valeurMax" => 11, "valeurNiv" => 3];
        $statistiquesModele["STATMOD_5525"] = ["lienModele" => "MODEL_Basilicgea", "lienStatistique" => "STAT_endur", "valeurMin" => 25, "valeurMax" => 30, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_6146"] = ["lienModele" => "MODEL_Ratsanguin", "lienStatistique" => "STAT_touch", "valeurMin" => 4, "valeurMax" => 6, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_6235"] = ["lienModele" => "MODEL_Ratsanguin", "lienStatistique" => "STAT_degat", "valeurMin" => 3, "valeurMax" => 5, "valeurNiv" => 7];
        $statistiquesModele["STATMOD_6334"] = ["lienModele" => "MODEL_Ratsanguin", "lienStatistique" => "STAT_resis", "valeurMin" => 3, "valeurMax" => 4, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_6481"] = ["lienModele" => "MODEL_Ratsanguin", "lienStatistique" => "STAT_vites", "valeurMin" => 8, "valeurMax" => 10, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_6513"] = ["lienModele" => "MODEL_Ratsanguin", "lienStatistique" => "STAT_endur", "valeurMin" => 13, "valeurMax" => 18, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_7147"] = ["lienModele" => "MODEL_Vertoxique", "lienStatistique" => "STAT_touch", "valeurMin" => 4, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_7256"] = ["lienModele" => "MODEL_Vertoxique", "lienStatistique" => "STAT_degat", "valeurMin" => 5, "valeurMax" => 6, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_7336"] = ["lienModele" => "MODEL_Vertoxique", "lienStatistique" => "STAT_resis", "valeurMin" => 3, "valeurMax" => 6, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_7435"] = ["lienModele" => "MODEL_Vertoxique", "lienStatistique" => "STAT_vites", "valeurMin" => 3, "valeurMax" => 5, "valeurNiv" => 4];
        $statistiquesModele["STATMOD_7515"] = ["lienModele" => "MODEL_Vertoxique", "lienStatistique" => "STAT_endur", "valeurMin" => 15, "valeurMax" => 18, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_8001"] = ["lienModele" => "MODEL_Guepeveni", "lienStatistique" => "STAT_touch", "valeurMin" => 5, "valeurMax" => 5, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_8002"] = ["lienModele" => "MODEL_Guepeveni", "lienStatistique" => "STAT_degat", "valeurMin" => 4, "valeurMax" => 6, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_8003"] = ["lienModele" => "MODEL_Guepeveni", "lienStatistique" => "STAT_resis", "valeurMin" => 3, "valeurMax" => 6, "valeurNiv" => 7];
        $statistiquesModele["STATMOD_8004"] = ["lienModele" => "MODEL_Guepeveni", "lienStatistique" => "STAT_vites", "valeurMin" => 5, "valeurMax" => 7, "valeurNiv" => 7];
        $statistiquesModele["STATMOD_8005"] = ["lienModele" => "MODEL_Guepeveni", "lienStatistique" => "STAT_endur", "valeurMin" => 10, "valeurMax" => 20, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_8011"] = ["lienModele" => "MODEL_Behemotde", "lienStatistique" => "STAT_touch", "valeurMin" => 7, "valeurMax" => 11, "valeurNiv" => 12];
        $statistiquesModele["STATMOD_8012"] = ["lienModele" => "MODEL_Behemotde", "lienStatistique" => "STAT_degat", "valeurMin" => 9, "valeurMax" => 12, "valeurNiv" => 12];
        $statistiquesModele["STATMOD_8013"] = ["lienModele" => "MODEL_Behemotde", "lienStatistique" => "STAT_resis", "valeurMin" => 6, "valeurMax" => 11, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_8014"] = ["lienModele" => "MODEL_Behemotde", "lienStatistique" => "STAT_vites", "valeurMin" => 3, "valeurMax" => 8, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_8015"] = ["lienModele" => "MODEL_Behemotde", "lienStatistique" => "STAT_endur", "valeurMin" => 22, "valeurMax" => 35, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_8021"] = ["lienModele" => "MODEL_Jeuneguiv", "lienStatistique" => "STAT_touch", "valeurMin" => 5, "valeurMax" => 8, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_8022"] = ["lienModele" => "MODEL_Jeuneguiv", "lienStatistique" => "STAT_degat", "valeurMin" => 8, "valeurMax" => 10, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_8023"] = ["lienModele" => "MODEL_Jeuneguiv", "lienStatistique" => "STAT_resis", "valeurMin" => 6, "valeurMax" => 12, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_8024"] = ["lienModele" => "MODEL_Jeuneguiv", "lienStatistique" => "STAT_vites", "valeurMin" => 4, "valeurMax" => 8, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_8025"] = ["lienModele" => "MODEL_Jeuneguiv", "lienStatistique" => "STAT_endur", "valeurMin" => 18, "valeurMax" => 23, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_8031"] = ["lienModele" => "MODEL_Scarabepu", "lienStatistique" => "STAT_touch", "valeurMin" => 4, "valeurMax" => 8, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_8032"] = ["lienModele" => "MODEL_Scarabepu", "lienStatistique" => "STAT_degat", "valeurMin" => 5, "valeurMax" => 10, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_8033"] = ["lienModele" => "MODEL_Scarabepu", "lienStatistique" => "STAT_resis", "valeurMin" => 4, "valeurMax" => 8, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_8034"] = ["lienModele" => "MODEL_Scarabepu", "lienStatistique" => "STAT_vites", "valeurMin" => 3, "valeurMax" => 6, "valeurNiv" => 7];
        $statistiquesModele["STATMOD_8035"] = ["lienModele" => "MODEL_Scarabepu", "lienStatistique" => "STAT_endur", "valeurMin" => 15, "valeurMax" => 22, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_8031"] = ["lienModele" => "MODEL_Dragonbla", "lienStatistique" => "STAT_touch", "valeurMin" => 14, "valeurMax" => 20, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_8032"] = ["lienModele" => "MODEL_Dragonbla", "lienStatistique" => "STAT_degat", "valeurMin" => 14, "valeurMax" => 20, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_8033"] = ["lienModele" => "MODEL_Dragonbla", "lienStatistique" => "STAT_resis", "valeurMin" => 14, "valeurMax" => 20, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_8034"] = ["lienModele" => "MODEL_Dragonbla", "lienStatistique" => "STAT_vites", "valeurMin" => 14, "valeurMax" => 20, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_8035"] = ["lienModele" => "MODEL_Dragonbla", "lienStatistique" => "STAT_endur", "valeurMin" => 300, "valeurMax" => 400, "valeurNiv" => 10];

        foreach ($statistiquesModele as $name => $statistiqueModele) {
            // Populate the objects
            $$name = new StatistiqueModele();
            $$name->setLienModele($this->getReference($statistiqueModele["lienModele"]))
                ->setLienStatistique($this->getReference($statistiqueModele["lienStatistique"]))
                ->setvaleurMin($statistiqueModele["valeurMin"])
                ->setvaleurMax($statistiqueModele["valeurMax"])
                ->setvaleurNiv($statistiqueModele["valeurNiv"]);
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }

        $manager->flush();
    }
}
