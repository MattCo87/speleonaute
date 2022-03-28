<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\ActionStrategie;
use phpDocumentor\Reflection\PseudoTypes\True_;

class ActionStrategieFixtures extends Fixture implements DependentFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getDependencies()
    {
        return [StrategieFixtures::class];
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {

        $identities = $this->referenceRepository->getIdentities();
        //dump($identities);
        $matchSTRAT = preg_grep("/STRAT_/", array_keys($identities));
        $matchACT = preg_grep("/ACT_/", array_keys($identities));
        $strategies = array_intersect_key($identities, array_flip($matchSTRAT));
        $actions = array_intersect_key($identities, array_flip($matchACT));
        //// Méthodes propres à l'Entity
        //dump($strategies);
        //dump($Actions);
        //dd("DONE");

        foreach ($strategies as $strategyName => $strategy) {
            //dd($strategy);
            dump("++++++++STRATEGY++$strategyName+++++++++");
            $tier = [1 => 0, 2 => 0, 3 => 0];
            foreach ($actions as $actionName => $action) {
                $strategiePure = str_contains($strategyName, "Pur");
                $actionNameRedux = str_replace(["ACT_", "1", "2", "3"], "", $actionName);
                $actionTier = $actionName[-1];
                dump("-------Action--$actionName--------");
                dump("TIER : " . $actionTier);
                dump($actionNameRedux);
                if ($tier[1] + $tier[2] + $tier[3] <= 4 && $tier[1] <= 2 & $tier[2] <= 2 && $tier[3] <= 1) {
                    if (str_contains($strategyName, $actionNameRedux)) {
                        switch ($actionTier) {
                            case 1:
                                $tier[1] = $tier[1] + 1;
                                dump("CASE 1");
                                break;

                            case 2:
                                $tier[2] = $tier[2] + 1;
                                dump("CASE 2");
                                break;

                            case 3:
                                $tier[3] = $tier[3] + 1;
                                dump("CASE 3");
                                break;

                            default:
                                dump("!!!!!!! NO CASE !!!!!!");
                                break;
                        }

                        $actStrat = new ActionStrategie();
                        $actStrat->setPositionAction(($tier[1] + $tier[2] + $tier[3]))
                            ->setLienAction($this->getReference($actionName))
                            ->setLienStrategie($this->getReference($strategyName));
                        $manager->persist($actStrat);
                        // Ajoute l'objet pour les autres fichiers de fixtures
                        $this->addReference("ACTSTRAT_" . $actionName . "_" . $strategyName . ($tier[1] + $tier[2] + $tier[3]), $actStrat);
                        dump($tier);
                    }
                }
            }
        }
        $manager->flush();
    }
}
