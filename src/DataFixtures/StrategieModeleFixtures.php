<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use App\Entity\StrategieModele;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class StrategieModeleFixtures extends Fixture implements OrderedFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getOrder()
    {
        return 6;
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $strategieModele = array();
        // Create the entries
        $strategieModele["STRATMOD_11"] = ["lienStrategie" => "STRAT_Ember", "lienModele" => "MODEL_Araignedes", "positionStrategie" => 1];
        $strategieModele["STRATMOD_22"] = ["lienStrategie" => "STRAT_Assau", "lienModele" => "MODEL_VerPsychiq", "positionStrategie" => 1];
        $strategieModele["STRATMOD_33"] = ["lienStrategie" => "STRAT_Depec", "lienModele" => "MODEL_Rejetonde", "positionStrategie" => 1];
        $strategieModele["STRATMOD_44"] = ["lienStrategie" => "STRAT_Netto", "lienModele" => "MODEL_Cubegelati", "positionStrategie" => 1];
        $strategieModele["STRATMOD_55"] = ["lienStrategie" => "STRAT_Figer", "lienModele" => "MODEL_Basilicgea", "positionStrategie" => 1];
        $strategieModele["STRATMOD_66"] = ["lienStrategie" => "STRAT_Attaq", "lienModele" => "MODEL_Ratsanguin", "positionStrategie" => 1];
        $strategieModele["STRATMOD_77"] = ["lienStrategie" => "STRAT_Poiso", "lienModele" => "MODEL_Vertoxique", "positionStrategie" => 1];

        foreach ($strategieModele as $name => $strategieMod) {
            // Populate the objects
            $$name = new StrategieModele();
            $$name->setLienStrategie($this->getReference($strategieMod["lienStrategie"]))
                ->setLienModele($this->getReference($strategieMod["lienModele"]))
                ->setPositionStrategie($strategieMod["positionStrategie"]);
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
        $manager->flush();
    }
}


//class StrategieFixtures extends Fixture implements OrderedFixtureInterface
//{
//    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
//    public function getOrder()
//    {
//        return 3;
//    }
//
//    // Chargement de l'objet provenant de l'Entity
//    public function load(ObjectManager $manager): void
//    {
//        $strategies = array();
//        for ($i = 1; $i <= 3; $i++) {
//            // Create the entries
//            $strategies["STRAT_PurEternuement" . $i] = ["nom" => "Combo d'éternuements de force $i"];
//            $strategies["STRAT_PurRoulement" . $i] = ["nom" => "Attaque roulade de force $i"];
//            $strategies["STRAT_PureFrappe" . $i] = ["nom" => "Combo de frappes de force $i"];
//            $strategies["STRAT_PurPoison" . $i] = ["nom" => "Combo poison de force $i"];
//            $strategies["STRAT_PureMagie" . $i] = ["nom" => "Pure attaque magique de force $i"];
//            $strategies["STRAT_PurEffondrement" . $i] = ["nom" => "Effondrement voûte de force $i"];
//            $strategies["STRAT_EternuementRoule" . $i] = ["nom" => "Combo Éternuements avec des Roulades de force $i"];
//            $strategies["STRAT_EternuementFrappe" . $i] = ["nom" => "Combo Éternuement et Frappe de force $i"];
//            $strategies["STRAT_PoisonMagie" . $i] = ["nom" => "Combo Poison et Magie de force $i"];
//            $strategies["STRAT_FrappeEffondrement" . $i] = ["nom" => "Combo Frappe et Effondrement de force $i"];
//            $strategies["STRAT_MagieEffondrement" . $i] = ["nom" => "Combo magie et effondrement de force $i"];
//        }
//        foreach ($strategies as $name => $strategy) {
//            // Populate the objects
//            $$name = new Strategie();
//            $$name->setNom($strategy["nom"]);
//            $manager->persist($$name);
//            $manager->flush();
//            $this->addReference($name, $$name);
//            //dump($name);
//            //dump($$name);
//        }
//    }
//}
//