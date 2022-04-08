<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use App\Entity\ActionStrategie;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ActionStrategieFixtures extends Fixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 4;
    }

    public function load(ObjectManager $manager): void
    {

        $actionStrategies = array();

        // Create the entries
        $actionStrategies["ACTIONSTRAT_1"] = ["lienStrategie" =>  "STRAT_Ember", "lienAction" => "ACT_toiledar", "positionAction" => 1];
        $actionStrategies["ACTIONSTRAT_2"] = ["lienStrategie" =>  "STRAT_Ember", "lienAction" => "ACT_toiledar", "positionAction" => 4];
        $actionStrategies["ACTIONSTRAT_3"] = ["lienStrategie" =>  "STRAT_Ember", "lienAction" => "ACT_embrochage", "positionAction" => 2];
        $actionStrategies["ACTIONSTRAT_4"] = ["lienStrategie" =>  "STRAT_Ember", "lienAction" => "ACT_embrochage", "positionAction" => 3];
        $actionStrategies["ACTIONSTRAT_5"] = ["lienStrategie" =>  "STRAT_Ember", "lienAction" => "ACT_morsuremo", "positionAction" => 5];
        $actionStrategies["ACTIONSTRAT_6"] = ["lienStrategie" =>  "STRAT_Assau", "lienAction" => "ACT_picpsychi", "positionAction" => 2];
        $actionStrategies["ACTIONSTRAT_7"] = ["lienStrategie" =>  "STRAT_Assau", "lienAction" => "ACT_picpsychi", "positionAction" => 4];
        $actionStrategies["ACTIONSTRAT_8"] = ["lienStrategie" =>  "STRAT_Assau", "lienAction" => "ACT_asservisse", "positionAction" => 1];
        $actionStrategies["ACTIONSTRAT_9"] = ["lienStrategie" =>  "STRAT_Assau", "lienAction" => "ACT_asservisse", "positionAction" => 5];
        $actionStrategies["ACTIONSTRAT_10"] = ["lienStrategie" =>  "STRAT_Assau", "lienAction" => "ACT_destructio", "positionAction" => 3];
        $actionStrategies["ACTIONSTRAT_11"] = ["lienStrategie" =>  "STRAT_Depec", "lienAction" => "ACT_griffures", "positionAction" => 1];
        $actionStrategies["ACTIONSTRAT_12"] = ["lienStrategie" =>  "STRAT_Depec", "lienAction" => "ACT_griffures", "positionAction" => 5];
        $actionStrategies["ACTIONSTRAT_13"] = ["lienStrategie" =>  "STRAT_Depec", "lienAction" => "ACT_eventremen", "positionAction" => 2];
        $actionStrategies["ACTIONSTRAT_14"] = ["lienStrategie" =>  "STRAT_Depec", "lienAction" => "ACT_eventremen", "positionAction" => 4];
        $actionStrategies["ACTIONSTRAT_15"] = ["lienStrategie" =>  "STRAT_Depec", "lienAction" => "ACT_dechiqueta", "positionAction" => 3];
        $actionStrategies["ACTIONSTRAT_16"] = ["lienStrategie" => "STRAT_Netto", "lienAction" => "ACT_jetdacid", "positionAction" =>  3];
        $actionStrategies["ACTIONSTRAT_17"] = ["lienStrategie" => "STRAT_Netto", "lienAction" => "ACT_jetdacid", "positionAction" =>  5];
        $actionStrategies["ACTIONSTRAT_18"] = ["lienStrategie" => "STRAT_Netto", "lienAction" => "ACT_engloutiss", "positionAction" =>  1];
        $actionStrategies["ACTIONSTRAT_19"] = ["lienStrategie" => "STRAT_Netto", "lienAction" => "ACT_engloutiss", "positionAction" =>  4];
        $actionStrategies["ACTIONSTRAT_20"] = ["lienStrategie" => "STRAT_Netto", "lienAction" => "ACT_digestion", "positionAction" =>  2];
        $actionStrategies["ACTIONSTRAT_21"] = ["lienStrategie" => "STRAT_Figer", "lienAction" => "ACT_charge vio", "positionAction" =>  2];
        $actionStrategies["ACTIONSTRAT_22"] = ["lienStrategie" => "STRAT_Figer", "lienAction" => "ACT_charge vio", "positionAction" =>  4];
        $actionStrategies["ACTIONSTRAT_23"] = ["lienStrategie" => "STRAT_Figer", "lienAction" => "ACT_javeline d", "positionAction" =>  3];
        $actionStrategies["ACTIONSTRAT_24"] = ["lienStrategie" => "STRAT_Figer", "lienAction" => "ACT_javeline d", "positionAction" =>  5];
        $actionStrategies["ACTIONSTRAT_25"] = ["lienStrategie" => "STRAT_Figer", "lienAction" => "ACT_regard petr", "positionAction" =>  1];
        $actionStrategies["ACTIONSTRAT_26"] = ["lienStrategie" => "STRAT_Attaq", "lienAction" => "ACT_griffe", "positionAction" =>  1];
        $actionStrategies["ACTIONSTRAT_27"] = ["lienStrategie" => "STRAT_Attaq", "lienAction" => "ACT_griffe", "positionAction" =>  5];
        $actionStrategies["ACTIONSTRAT_28"] = ["lienStrategie" => "STRAT_Attaq", "lienAction" => "ACT_ecorchure", "positionAction" =>  3];
        $actionStrategies["ACTIONSTRAT_29"] = ["lienStrategie" => "STRAT_Attaq", "lienAction" => "ACT_ecorchure", "positionAction" =>  4];
        $actionStrategies["ACTIONSTRAT_30"] = ["lienStrategie" => "STRAT_Attaq", "lienAction" => "ACT_morsuremu", "positionAction" =>  2];
        $actionStrategies["ACTIONSTRAT_31"] = ["lienStrategie" => "STRAT_Poiso", "lienAction" => "ACT_bavetoxiq", "positionAction" =>  3];
        $actionStrategies["ACTIONSTRAT_32"] = ["lienStrategie" => "STRAT_Poiso", "lienAction" => "ACT_bavetoxiq", "positionAction" =>  5];
        $actionStrategies["ACTIONSTRAT_33"] = ["lienStrategie" => "STRAT_Poiso", "lienAction" => "ACT_contactaf", "positionAction" =>  2];
        $actionStrategies["ACTIONSTRAT_34"] = ["lienStrategie" => "STRAT_Poiso", "lienAction" => "ACT_contactaf", "positionAction" =>  4];
        $actionStrategies["ACTIONSTRAT_35"] = ["lienStrategie" => "STRAT_Poiso", "lienAction" => "ACT_jetdepois", "positionAction" =>  1];

        foreach ($actionStrategies as $name => $actionStrategie) {
            // Populate the objects
            $$name = new ActionStrategie();
            $$name->setLienStrategie($this->getReference($actionStrategie["lienStrategie"]))
                ->setLienAction($this->getReference($actionStrategie["lienAction"]))
                ->setPositionAction($actionStrategie["positionAction"]);
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }

        $manager->flush();
    }
}


// Ancien mécanisme de génération d'actions par tier (ActionFIxtures.php ActionStrategieFixtures.php et StrategieFixtures.php)
//
//class ActionStrategieFixtures extends Fixture implements OrderedFixtureInterface
//{
//    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
//    public function getOrder()
//    {
//        return 4;
//    }
//
//    // Chargement de l'objet provenant de l'Entity
//    public function load(ObjectManager $manager): void
//    {
//
//        $identities = $this->referenceRepository->getIdentities();
//        //dump($identities);
//        $matchSTRAT = preg_grep("/STRAT_/", array_keys($identities));
//        $matchACT = preg_grep("/ACT_/", array_keys($identities));
//        $strategies = array_intersect_key($identities, array_flip($matchSTRAT));
//        $actionStrategies = array_intersect_key($identities, array_flip($matchACT));
//        //// Méthodes propres à l'Entity
//        //dump($strategies);
//        //dump($actionStrategies);
//        //dd("DONE");
//
//        foreach ($strategies as $strategyName => $strategy) {
//            //dd($strategy);
//            dump("++++++++STRATEGY++$strategyName+++++++++");
//            $tier = [1 => 0, 2 => 0, 3 => 0];
//            foreach ($actionStrategies as $actionStrategieName => $actionStrategie) {
//                $strategiePure = str_contains($strategyName, "Pur");
//                $actionStrategieNameRedux = str_replace(["ACT_", "1", "2", "3"], "", $actionStrategieName);
//                $actionStrategieTier = $actionStrategieName[-1];
//                dump("-------Action--$actionStrategieName--------");
//                dump("TIER : " . $actionStrategieTier);
//                dump($actionStrategieNameRedux);
//                if ($tier[1] + $tier[2] + $tier[3] <= 4 && $tier[1] <= 2 & $tier[2] <= 2 && $tier[3] <= 1) {
//                    if (str_contains($strategyName, $actionStrategieNameRedux)) {
//                        switch ($actionStrategieTier) {
//                            case 1:
//                                $tier[1] = $tier[1] + 1;
//                                dump("CASE 1");
//                                break;
//
//                            case 2:
//                                $tier[2] = $tier[2] + 1;
//                                dump("CASE 2");
//                                break;
//
//                            case 3:
//                                $tier[3] = $tier[3] + 1;
//                                dump("CASE 3");
//                                break;
//
//                            default:
//                                dump("!!!!!!! NO CASE !!!!!!");
//                                break;
//                        }
//
//                        $actStrat = new ActionStrategie();
//                        $actStrat->setPositionAction(($tier[1] + $tier[2] + $tier[3]))
//                            ->setLienAction($this->getReference($actionStrategieName))
//                            ->setLienStrategie($this->getReference($strategyName));
//                        $manager->persist($actStrat);
//                        // Ajoute l'objet pour les autres fichiers de fixtures
//                        $this->addReference("ACTSTRAT_" . $actionStrategieName . "_" . $strategyName . ($tier[1] + $tier[2] + $tier[3]), $actStrat);
//                        dump($tier);
//                    }
//                }
//            }
//        }
//        $manager->flush();
//    }
//}
//