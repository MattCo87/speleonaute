<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Strategie;

class StrategieFixtures extends Fixture implements DependentFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getDependencies()
    {
        return [ActionFixtures::class];
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $strategies = array();
        for ($i = 1; $i <= 3; $i++) {
            // Create the entries
            $strategies["STRAT_PurEternuement" . $i] = ["nom" => "Combo d'éternuements de force $i"];
            $strategies["STRAT_PurRoulement" . $i] = ["nom" => "Attaque roulade de force $i"];
            $strategies["STRAT_PureFrappe" . $i] = ["nom" => "Combo de frappes de force $i"];
            $strategies["STRAT_PurPoison" . $i] = ["nom" => "Combo poison de force $i"];
            $strategies["STRAT_PureMagie" . $i] = ["nom" => "Pure attaque magique de force $i"];
            $strategies["STRAT_PurEffondrement" . $i] = ["nom" => "Effondrement voûte de force $i"];
            $strategies["STRAT_EternuementRoule" . $i] = ["nom" => "Combo Éternuements avec des Roulades de force $i"];
            $strategies["STRAT_EternuementFrappe" . $i] = ["nom" => "Combo Éternuement et Frappe de force $i"];
            $strategies["STRAT_PoisonMagie" . $i] = ["nom" => "Combo Poison et Magie de force $i"];
            $strategies["STRAT_FrappeEffondrement" . $i] = ["nom" => "Combo Frappe et Effondrement de force $i"];
            $strategies["STRAT_MagieEffondrement" . $i] = ["nom" => "Combo magie et effondrement de force $i"];
        }
        foreach ($strategies as $name => $strategy) {
            // Populate the objects
            $$name = new Strategie();
            $$name->setNom($strategy["nom"]);
            $manager->persist($$name);
            $manager->flush();
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
    }
}
