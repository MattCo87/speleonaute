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
        $actionStrategies["1-1"] = ["lienStrategie" => $this->getReference("STRAT_Ember"), "lienAction" => $this->getReference("ACT_toiledar"), "positionAction" => 1];
        $actionStrategies["1-1"] = ["lienStrategie" => $this->getReference("STRAT_Ember"), "lienAction" => $this->getReference("ACT_toiledar"), "positionAction" => 4];
        $actionStrategies["1-2"] = ["lienStrategie" => $this->getReference("STRAT_Ember"), "lienAction" => $this->getReference("ACT_embrochage"), "positionAction" => 2];
        $actionStrategies["1-2"] = ["lienStrategie" => $this->getReference("STRAT_Ember"), "lienAction" => $this->getReference("ACT_embrochage"), "positionAction" => 3];
        $actionStrategies["1-3"] = ["lienStrategie" => $this->getReference("STRAT_Ember"), "lienAction" => $this->getReference("ACT_morsuremo"), "positionAction" => 5];
        $actionStrategies["2-4"] = ["lienStrategie" => $this->getReference("STRAT_Assau"), "lienAction" => $this->getReference("ACT_picpsychi"), "positionAction" => 2];
        $actionStrategies["2-4"] = ["lienStrategie" => $this->getReference("STRAT_Assau"), "lienAction" => $this->getReference("ACT_picpsychi"), "positionAction" => 4];
        $actionStrategies["2-5"] = ["lienStrategie" => $this->getReference("STRAT_Assau"), "lienAction" => $this->getReference("ACT_asservisse"), "positionAction" => 1];
        $actionStrategies["2-5"] = ["lienStrategie" => $this->getReference("STRAT_Assau"), "lienAction" => $this->getReference("ACT_asservisse"), "positionAction" => 5];
        $actionStrategies["2-6"] = ["lienStrategie" => $this->getReference("STRAT_Assau"), "lienAction" => $this->getReference("ACT_destructio"), "positionAction" => 3];
        $actionStrategies["3-7"] = ["lienStrategie" => $this->getReference("STRAT_Depec"), "lienAction" => $this->getReference("ACT_griffures"), "positionAction" => 1];
        $actionStrategies["3-7"] = ["lienStrategie" => $this->getReference("STRAT_Depec"), "lienAction" => $this->getReference("ACT_griffures"), "positionAction" => 5];
        $actionStrategies["3-8"] = ["lienStrategie" => $this->getReference("STRAT_Depec"), "lienAction" => $this->getReference("ACT_eventremen"), "positionAction" => 2];
        $actionStrategies["3-8"] = ["lienStrategie" => $this->getReference("STRAT_Depec"), "lienAction" => $this->getReference("ACT_eventremen"), "positionAction" => 4];
        $actionStrategies["3-9"] = ["lienStrategie" => $this->getReference("STRAT_Depec"), "lienAction" => $this->getReference("ACT_dechiqueta"), "positionAction" => 3];
        $actionStrategies["4-10"] = ["lienStrategie" => $this->getReference("STRAT_Netto"), "lienAction" => $this->getReference("ACT_jetdacid"), "positionAction" =>  3];
        $actionStrategies["4-10"] = ["lienStrategie" => $this->getReference("STRAT_Netto"), "lienAction" => $this->getReference("ACT_jetdacid"), "positionAction" =>  5];
        $actionStrategies["4-11"] = ["lienStrategie" => $this->getReference("STRAT_Netto"), "lienAction" => $this->getReference("ACT_engloutiss"), "positionAction" =>  1];
        $actionStrategies["4-11"] = ["lienStrategie" => $this->getReference("STRAT_Netto"), "lienAction" => $this->getReference("ACT_engloutiss"), "positionAction" =>  4];
        $actionStrategies["4-12"] = ["lienStrategie" => $this->getReference("STRAT_Netto"), "lienAction" => $this->getReference("ACT_digestion "), "positionAction" =>  2];
        $actionStrategies["5-13"] = ["lienStrategie" => $this->getReference("STRAT_Figer"), "lienAction" => $this->getReference("ACT_charge vio"), "positionAction" =>  2];
        $actionStrategies["5-13"] = ["lienStrategie" => $this->getReference("STRAT_Figer"), "lienAction" => $this->getReference("ACT_charge vio"), "positionAction" =>  4];
        $actionStrategies["5-14"] = ["lienStrategie" => $this->getReference("STRAT_Figer"), "lienAction" => $this->getReference("ACT_javeline d"), "positionAction" =>  3];
        $actionStrategies["5-14"] = ["lienStrategie" => $this->getReference("STRAT_Figer"), "lienAction" => $this->getReference("ACT_javeline d"), "positionAction" =>  5];
        $actionStrategies["5-15"] = ["lienStrategie" => $this->getReference("STRAT_Figer"), "lienAction" => $this->getReference("ACT_regard petr"), "positionAction" =>  1];
        $actionStrategies["6-16"] = ["lienStrategie" => $this->getReference("STRAT_Attaq"), "lienAction" => $this->getReference("ACT_griffe"), "positionAction" =>  1];
        $actionStrategies["6-16"] = ["lienStrategie" => $this->getReference("STRAT_Attaq"), "lienAction" => $this->getReference("ACT_griffe"), "positionAction" =>  5];
        $actionStrategies["6-17"] = ["lienStrategie" => $this->getReference("STRAT_Attaq"), "lienAction" => $this->getReference("ACT_ecorchure "), "positionAction" =>  3];
        $actionStrategies["6-17"] = ["lienStrategie" => $this->getReference("STRAT_Attaq"), "lienAction" => $this->getReference("ACT_ecorchure "), "positionAction" =>  4];
        $actionStrategies["6-18"] = ["lienStrategie" => $this->getReference("STRAT_Attaq"), "lienAction" => $this->getReference("ACT_morsuremu"), "positionAction" =>  2];
        $actionStrategies["7-19"] = ["lienStrategie" => $this->getReference("STRAT_Poiso"), "lienAction" => $this->getReference("ACT_bavetoxiq"), "positionAction" =>  3];
        $actionStrategies["7-19"] = ["lienStrategie" => $this->getReference("STRAT_Poiso"), "lienAction" => $this->getReference("ACT_bavetoxiq"), "positionAction" =>  5];
        $actionStrategies["7-20"] = ["lienStrategie" => $this->getReference("STRAT_Poiso"), "lienAction" => $this->getReference("ACT_contactaf"), "positionAction" =>  2];
        $actionStrategies["7-20"] = ["lienStrategie" => $this->getReference("STRAT_Poiso"), "lienAction" => $this->getReference("ACT_contactaf"), "positionAction" =>  4];
        $actionStrategies["7-21"] = ["lienStrategie" => $this->getReference("STRAT_Poiso"), "lienAction" => $this->getReference("ACT_jetdepois"), "positionAction" =>  1];


        foreach ($actionStrategies as $name => $actionStrategie) {
            // Populate the objects
            $$name = new ActionStrategie();
            $$name->setLienStrategie($actionStrategie["lienStrategie"])
                ->setLienAction($actionStrategie["lienAction"])
                ->setPositionAction($actionStrategie["positionAction"]);
            $manager->persist($$name);
            $manager->flush();
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
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