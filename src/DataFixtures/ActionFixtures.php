<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Action;

class ActionFixtures extends Fixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager): void
    {

        $actions = array();

        // Create the entries
        $actions["ACT_toiledar"] = ["nom" => "toile d'araignée ", "tier" => 1, "toucher" => 3, "degat" => 2];
        $actions["ACT_embrochage"] = ["nom" => "embrochage ", "tier" => 2, "toucher" => 4, "degat" => 5];
        $actions["ACT_morsuremo"] = ["nom" => "Morsure mortelle ", "tier" => 3, "toucher" => 5, "degat" => 9];
        $actions["ACT_picpsychi"] = ["nom" => "pic psychique ", "tier" => 1, "toucher" => 1, "degat" => 5];
        $actions["ACT_asservisse"] = ["nom" => "asservissement ", "tier" => 2, "toucher" => 2, "degat" => 9];
        $actions["ACT_destructio"] = ["nom" => "destruction d’esprit ", "tier" => 3, "toucher" => 3, "degat" => 13];
        $actions["ACT_griffures"] = ["nom" => "griffure sanglante ", "tier" => 1, "toucher" => 2, "degat" => 3];
        $actions["ACT_eventremen"] = ["nom" => "éventrement ", "tier" => 2, "toucher" => 5, "degat" => 4];
        $actions["ACT_dechiqueta"] = ["nom" => "Déchiquetage d’entrailles", "tier" => 3, "toucher" => 7, "degat" => 8];
        $actions["ACT_jetdacid"] = ["nom" => "jet d’acide ", "tier" => 1, "toucher" => 3, "degat" => 4];
        $actions["ACT_engloutiss"] = ["nom" => "engloutissement ", "tier" => 2, "toucher" => 5, "degat" => 8];
        $actions["ACT_digestion"] = ["nom" => "digestion ", "tier" => 3, "toucher" => 7, "degat" => 12];
        $actions["ACT_charge vio"] = ["nom" => "Charge violente ", "tier" => 1, "toucher" => 1, "degat" => 6];
        $actions["ACT_javeline d"] = ["nom" => "Javeline dorsale ", "tier" => 2, "toucher" => 8, "degat" => 9];
        $actions["ACT_regard petr"] = ["nom" => "Regard pétrifiant ", "tier" => 3, "toucher" => 5, "degat" => 15];
        $actions["ACT_griffe"] = ["nom" => "griffe ", "tier" => 1, "toucher" => 1, "degat" => 2];
        $actions["ACT_ecorchure"] = ["nom" => "ecorchure profonde ", "tier" => 2, "toucher" => 3, "degat" => 5];
        $actions["ACT_morsuremu"] = ["nom" => "morsure multiple ", "tier" => 3, "toucher" => 5, "degat" => 8];
        $actions["ACT_bavetoxiq"] = ["nom" => "bave toxique ", "tier" => 1, "toucher" => 2, "degat" => 3];
        $actions["ACT_contactaf"] = ["nom" => "contact affaiblissant ", "tier" => 2, "toucher" => 4, "degat" => 4];
        $actions["ACT_jetdepois"] = ["nom" => "jet de poison ", "tier" => 3, "toucher" => 7, "degat" => 9];
        $actions["ACT_dardempoi"] = ["nom" => "dard empoisonnée ", "tier" => 1, "toucher" => 2, "degat" => 3];
        $actions["ACT_mortvenue"] = ["nom" => "mort venue du ciel ", "tier" => 3, "toucher" => 6, "degat" => 8];
        $actions["ACT_perforati"] = ["nom" => "perforation toxique ", "tier" => 2, "toucher" => 5, "degat" => 4];
        $actions["ACT_chargedes"] = ["nom" => "charge destructrice ", "tier" => 2, "toucher" => 6, "degat" => 12];
        $actions["ACT_pietineme"] = ["nom" => "piétinement incessant ", "tier" => 1, "toucher" => 4, "degat" => 4];
        $actions["ACT_briseos"] = ["nom" => " ", "tier" => 3, "toucher" => 7, "degat" => 14];
        $actions["ACT_seismeter"] = ["nom" => "seisme terrible ", "tier" => 3, "toucher" => 10, "degat" => 8];
        $actions["ACT_amputatio"] = ["nom" => "amputation vorace ", "tier" => 2, "toucher" => 3, "degat" => 7];
        $actions["ACT_ensevelis"] = ["nom" => "ensevelissement ", "tier" => 1, "toucher" => 1, "degat" => 4];
        $actions["ACT_devoremen"] = ["nom" => "dévorement ", "tier" => 3, "toucher" => 8, "degat" => 9];
        $actions["ACT_ailetranc"] = ["nom" => "aile tranchante ", "tier" => 2, "toucher" => 5, "degat" => 6];
        $actions["ACT_morsurevo"] = ["nom" => "morsure vorace ", "tier" => 1, "toucher" => 4, "degat" => 3];
        $actions["ACT_auraterri"] = ["nom" => "aura terrifiante ", "tier" => 1, "toucher" => 7, "degat" => 8];
        $actions["ACT_regardmor"] = ["nom" => "regard mortelle ", "tier" => 2, "toucher" => 10, "degat" => 15];
        $actions["ACT_soufflede"] = ["nom" => "souffle destructeur ", "tier" => 3, "toucher" => 15, "degat" => 20];


        foreach ($actions as $name => $action) {
            // Populate the objects
            $$name = new Action();
            $$name->setNom($action["nom"])
                ->setTier($action["tier"])
                ->setToucher($action["toucher"])
                ->setDegat($action["degat"]);
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
//class ActionFixtures extends Fixture implements OrderedFixtureInterface
//{
//    public function getOrder()
//    {
//        return 2;
//    }
//
//    public function load(ObjectManager $manager): void
//    {
//
//        $actions = array();
//        for ($i = 1; $i < 4; $i++) {
//            // Create the entries
//            $actions["ACT_Eternuement" . $i] = ["nom" => "Éternuement force $i", "toucher" => $i * 1, "degat" => $i * 1, "tier" => 1];
//            $actions["ACT_Frappe" . $i] = ["nom" => "Frappe force $i", "toucher" => $i * 1 + 1, "degat" => $i * 1 + 1, "tier" => 1];
//            $actions["ACT_Roulement" . $i] = ["nom" => "Frappe roulée force $i", "toucher" => $i * 2 + 1, "degat" => $i * 2 + 1, "tier" => 2];
//            $actions["ACT_Poison" . $i] = ["nom" => "Poison force $i", "toucher" => $i * 3, "degat" => $i * 3, "tier" => 3];
//            $actions["ACT_Magie" . $i] = ["nom" => "Magie force $i", "toucher" => $i * 3, "degat" => $i * 3, "tier" => 3];
//            $actions["ACT_Effondrement" . $i] = ["nom" => "Effondrement force $i", "toucher" => $i * 3 + 1, "degat" => $i * 3 + 1, "tier" => 3];
//        }
//
//        foreach ($actions as $name => $action) {
//            // Populate the objects
//            $$name = new Action();
//            $$name->setNom($action["nom"])
//                ->setToucher($action["toucher"])
//                ->setDegat($action["degat"])
//                ->setTier($action["tier"]);
//            $manager->persist($$name);
//            $manager->flush();
//            $this->addReference($name, $$name);
//            //dump($name);
//            //dump($$name);
//        }
//    }
//}
//