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

        dump($this->referenceRepository->getIdentities());
        $statistiquesModele = array();

        // Create the entries
        $statistiquesModele["STATMOD_1147"] = ["lienModele" => $this->getReference("MODEL_Araignedes"), "lienStatistique" => $this->getReference("STAT_touch"), "valeurMin" => 4, "valeurMax" => 7, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_1236"] = ["lienModele" => $this->getReference("MODEL_Araignedes"), "lienStatistique" => $this->getReference("STAT_degat"), "valeurMin" => 3, "valeurMax" => 6, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_1335"] = ["lienModele" => $this->getReference("MODEL_Araignedes"), "lienStatistique" => $this->getReference("STAT_resis"), "valeurMin" => 3, "valeurMax" => 5, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_1468"] = ["lienModele" => $this->getReference("MODEL_Araignedes"), "lienStatistique" => $this->getReference("STAT_vites"), "valeurMin" => 6, "valeurMax" => 8, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_1515"] = ["lienModele" => $this->getReference("MODEL_Araignedes"), "lienStatistique" => $this->getReference("STAT_endur"), "valeurMin" => 15, "valeurMax" => 20, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_2157"] = ["lienModele" => $this->getReference("MODEL_VerPsychiq"), "lienStatistique" => $this->getReference("STAT_touch"), "valeurMin" => 5, "valeurMax" => 7, "valeurNiv" => 11];
        $statistiquesModele["STATMOD_2247"] = ["lienModele" => $this->getReference("MODEL_VerPsychiq"), "lienStatistique" => $this->getReference("STAT_degat"), "valeurMin" => 4, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_2336"] = ["lienModele" => $this->getReference("MODEL_VerPsychiq"), "lienStatistique" => $this->getReference("STAT_resis"), "valeurMin" => 3, "valeurMax" => 6, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_2434"] = ["lienModele" => $this->getReference("MODEL_VerPsychiq"), "lienStatistique" => $this->getReference("STAT_vites"), "valeurMin" => 3, "valeurMax" => 4, "valeurNiv" => 3];
        $statistiquesModele["STATMOD_2518"] = ["lienModele" => $this->getReference("MODEL_VerPsychiq"), "lienStatistique" => $this->getReference("STAT_endur"), "valeurMin" => 18, "valeurMax" => 23, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_3137"] = ["lienModele" => $this->getReference("MODEL_Rejetonde"), "lienStatistique" => $this->getReference("STAT_touch"), "valeurMin" => 3, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_3237"] = ["lienModele" => $this->getReference("MODEL_Rejetonde"), "lienStatistique" => $this->getReference("STAT_degat"), "valeurMin" => 3, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_3337"] = ["lienModele" => $this->getReference("MODEL_Rejetonde"), "lienStatistique" => $this->getReference("STAT_resis"), "valeurMin" => 3, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_3468"] = ["lienModele" => $this->getReference("MODEL_Rejetonde"), "lienStatistique" => $this->getReference("STAT_vites"), "valeurMin" => 6, "valeurMax" => 8, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_3510"] = ["lienModele" => $this->getReference("MODEL_Rejetonde"), "lienStatistique" => $this->getReference("STAT_endur"), "valeurMin" => 10, "valeurMax" => 25, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_4148"] = ["lienModele" => $this->getReference("MODEL_Cubegelati"), "lienStatistique" => $this->getReference("STAT_touch"), "valeurMin" => 4, "valeurMax" => 8, "valeurNiv" => 10];
        $statistiquesModele["STATMOD_4269"] = ["lienModele" => $this->getReference("MODEL_Cubegelati"), "lienStatistique" => $this->getReference("STAT_degat"), "valeurMin" => 6, "valeurMax" => 9, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_4381"] = ["lienModele" => $this->getReference("MODEL_Cubegelati"), "lienStatistique" => $this->getReference("STAT_resis"), "valeurMin" => 8, "valeurMax" => 12, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_4434"] = ["lienModele" => $this->getReference("MODEL_Cubegelati"), "lienStatistique" => $this->getReference("STAT_vites"), "valeurMin" => 3, "valeurMax" => 4, "valeurNiv" => 2];
        $statistiquesModele["STATMOD_4520"] = ["lienModele" => $this->getReference("MODEL_Cubegelati"), "lienStatistique" => $this->getReference("STAT_endur"), "valeurMin" => 20, "valeurMax" => 30, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_5181"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_touch"), "valeurMin" => 8, "valeurMax" => 10, "valeurNiv" => 11];
        $statistiquesModele["STATMOD_5271"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_degat"), "valeurMin" => 7, "valeurMax" => 11, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_5371"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_resis"), "valeurMin" => 7, "valeurMax" => 10, "valeurNiv" => 7];
        $statistiquesModele["STATMOD_5461"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_vites"), "valeurMin" => 6, "valeurMax" => 11, "valeurNiv" => 3];
        $statistiquesModele["STATMOD_5525"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_endur"), "valeurMin" => 25, "valeurMax" => 30, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_6146"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_touch"), "valeurMin" => 4, "valeurMax" => 6, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_6235"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_degat"), "valeurMin" => 3, "valeurMax" => 5, "valeurNiv" => 7];
        $statistiquesModele["STATMOD_6334"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_resis"), "valeurMin" => 3, "valeurMax" => 4, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_6481"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_vites"), "valeurMin" => 8, "valeurMax" => 10, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_6513"] = ["lienModele" => $this->getReference("MODEL_Basilicgea"), "lienStatistique" => $this->getReference("STAT_endur"), "valeurMin" => 13, "valeurMax" => 18, "valeurNiv" => 5];
        $statistiquesModele["STATMOD_7147"] = ["lienModele" => $this->getReference("MODEL_Vertoxique"), "lienStatistique" => $this->getReference("STAT_touch"), "valeurMin" => 4, "valeurMax" => 7, "valeurNiv" => 9];
        $statistiquesModele["STATMOD_7256"] = ["lienModele" => $this->getReference("MODEL_Vertoxique"), "lienStatistique" => $this->getReference("STAT_degat"), "valeurMin" => 5, "valeurMax" => 6, "valeurNiv" => 8];
        $statistiquesModele["STATMOD_7336"] = ["lienModele" => $this->getReference("MODEL_Vertoxique"), "lienStatistique" => $this->getReference("STAT_resis"), "valeurMin" => 3, "valeurMax" => 6, "valeurNiv" => 6];
        $statistiquesModele["STATMOD_7435"] = ["lienModele" => $this->getReference("MODEL_Vertoxique"), "lienStatistique" => $this->getReference("STAT_vites"), "valeurMin" => 3, "valeurMax" => 5, "valeurNiv" => 4];
        $statistiquesModele["STATMOD_7515"] = ["lienModele" => $this->getReference("MODEL_Vertoxique"), "lienStatistique" => $this->getReference("STAT_endur"), "valeurMin" => 15, "valeurMax" => 18, "valeurNiv" => 6];

        foreach ($statistiquesModele as $name => $statistiqueModele) {
            // Populate the objects
            $$name = new StatistiqueModele();
            $$name->setLienStrategie($statistiqueModele["lienModele"])
                ->setLienAction($statistiqueModele["lienStatistique"])
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
