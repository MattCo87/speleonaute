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
            dump("+++++++++++++++++");
            $tier = [1 => 1, 2 => 0, 3 => 0];
            foreach ($actions as $actionName => $action) {
                dump($tier);
                $strategiePure = str_contains($strategyName, "Pur");
                $actionNameRedux = str_replace(["ACT_", "1", "2", "3"], "", $actionName);
                $actionTier = $actionName[-1];
                dump("-------TIER-------");
                dump("TIER : " . $actionTier);
                dump($strategyName);
                dump($actionNameRedux);
                if (($tier[1] + $tier[2] + $tier[3]) <= 5) {
                    if (str_contains($strategyName, $actionNameRedux)) {
                        if ($strategiePure) {
                            for ($tier[1] <= 2; $tier[1] = $tier[1] + 1;) {
                                $actStrat = new ActionStrategie();
                                $actStrat->setPositionAction(($tier[1] + $tier[2] + $tier[3]))
                                    ->setLienAction($this->getReference($actionName))
                                    ->setLienStrategie($this->getReference($strategyName));
                                $manager->persist($actStrat);
                                $manager->flush();
                                // Ajoute l'objet pour les autres fichiers de fixtures
                                $this->addReference("ACTSTRAT_" . $actionName . "_" . $strategyName . ($tier[1] + $tier[2] + $tier[3]), $actStrat);
                                dump("ACTSTRAT_" . $actionName . "_" . $strategyName);
                                dump("_______________________________________________");
                            }
                        }
                    }
                }
            }
        }
    }
}
