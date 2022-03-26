<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Action;

class ActionFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [UserFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {

        $actions = array();
        for ($i = 1; $i < 4; $i++) {
            // Create the entries
            $actions["Et" . $i] = ["nom" => "Éternuement force $i", "toucher" => $i * 1, "degat" => $i * 1, "tier" => 1];
            $actions["Fr" . $i] = ["nom" => "Frappe force $i", "toucher" => $i * 1 + 1, "degat" => $i * 1 + 1, "tier" => 1];
            $actions["Action" . $i] = ["nom" => "Frappe glissée force $i", "toucher" => $i * 2, "degat" => $i * 2, "tier" => 2];
            $actions["FrRoul" . $i] = ["nom" => "Frappe roulée force $i", "toucher" => $i * 2 + 1, "degat" => $i * 2 + 1, "tier" => 2];
            $actions["Pois" . $i] = ["nom" => "Poison force $i", "toucher" => $i * 3, "degat" => $i * 3, "tier" => 3];
            $actions["Mag" . $i] = ["nom" => "Magie force $i", "toucher" => $i * 3, "degat" => $i * 3, "tier" => 3];
            $actions["Action" . $i] = ["nom" => "Effondrement force $i", "toucher" => $i * 3 + 1, "degat" => $i * 3 + 1, "tier" => 3];
        }

        foreach ($actions as $name => $action) {
            // Populate the objects
            $$name = new Action();
            $$name->setNom($action["nom"])
                ->setToucher($action["toucher"])
                ->setDegat($action["degat"])
                ->setTier($action["tier"]);
            $manager->persist($$name);
            $manager->flush();
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
    }
}