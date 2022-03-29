<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Modele;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ModeleFixtures extends Fixture implements OrderedFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getOrder()
    {
        return 5;
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $modeles = array();
        for ($i = 1; $i <= 2; $i++) {
            // Create the entries
            $modèles["MODEL_Araignedes"] = ["nom_modele" => "Araignée des cavernes", "rarete" => 2, "point_niv" => 5, "ouvrable" => TRUE];
            $modèles["MODEL_VerPsychiq"] = ["nom_modele" => "Ver Psychique", "rarete" => 3, "point_niv" => 5, "ouvrable" => TRUE];
            $modèles["MODEL_Rejetonde"] = ["nom_modele" => "Rejeton de la fosse", "rarete" => 2, "point_niv" => 5, "ouvrable" => TRUE];
            $modèles["MODEL_Cubegelati"] = ["nom_modele" => "Cube gélatineux", "rarete" => 4, "point_niv" => 5, "ouvrable" => TRUE];
            $modèles["MODEL_Basilicgea"] = ["nom_modele" => "Basilic géant", "rarete" => 5, "point_niv" => 6, "ouvrable" => TRUE];
            $modèles["MODEL_Ratsanguin"] = ["nom_modele" => "Rat sanguinaire", "rarete" => 1, "point_niv" => 5, "ouvrable" => FALSE];
            $modèles["MODEL_Vertoxique"] = ["nom_modele" => "Ver toxique", "rarete" => 2, "point_niv" => 5, "ouvrable" => FALSE];
        }

        foreach ($modeles as $name => $modele) {
            // Populate the objects
            $$name = new Modele();
            $$name->setNomModele($modele["nom_modele"])
                ->setRarete($modele["rarete"])
                ->setPointNiv($modele["point_niv"])
                ->setOuvrable($modele["ouvrable"]);
            $manager->persist($$name);
            $manager->flush();
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
    }
}






//class ModeleFixtures extends Fixture implements OrderedFixtureInterface
//{
//    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
//    public function getOrder()
//    {
//        return 5;
//    }
//
//    // Chargement de l'objet provenant de l'Entity
//    public function load(ObjectManager $manager): void
//    {
//        $modeles = array();
//        for ($i = 1; $i <= 2; $i++) {
//            // Create the entries
//            $modeles["MODEL_Ratus" . $i] = ["nom_modele" => "Rat des cavernes de niveau $i", "rarete" => $i, "point_niv" => $i, "ouvrable" => TRUE];
//            $modeles["MODEL_Chiroptera" . $i] = ["nom_modele" => "Chiroptère de niveau $i", "rarete" => $i, "point_niv" => $i, "ouvrable" => TRUE];
//            $modeles["MODEL_Boa" . $i] = ["nom_modele" => "Boa cavernicole de niveau $i", "rarete" => $i + 2, "point_niv" => $i + 2, "ouvrable" => TRUE];
//            $modeles["MODEL_Dionea" . $i] = ["nom_modele" => "Dionée mutante de niveau $i", "rarete" => $i + 1, "point_niv" => $i, "ouvrable" => TRUE];
//            $modeles["MODEL_Myriapode" . $i] = ["nom_modele" => "Myriapode venimeux de niveau $i", "rarete" => $i, "point_niv" => $i, "ouvrable" => TRUE];
//            $modeles["MODEL_Amphibia" . $i] = ["nom_modele" => "Salamandre venimeuse de niveau $i", "rarete" => $i + 1, "point_niv" => $i + 1, "ouvrable" => TRUE];
//            $modeles["MODEL_Megatherium"] = ["nom_modele" => "Paresseux cavernicole des temps anciens", "rarete" => "5", "point_niv" => "6", "ouvrable" => FALSE];
//            $modeles["MODEL_Behemoth"] = ["nom_modele" => "Monstre aquatique profond", "rarete" => "5", "point_niv" => "6", "ouvrable" => FALSE];
//            $modeles["MODEL_Leviathan"] = ["nom_modele" => "Céphalopode géant des profondeurs", "rarete" => "5", "point_niv" => "6", "ouvrable" => FALSE];
//            $modeles["MODEL_Abomination"] = ["nom_modele" => "Cthulhu R'lyeh wgah'nagl fhtagn", "rarete" => "5", "point_niv" => "6", "ouvrable" => FALSE];
//        }
//        foreach ($modeles as $name => $modele) {
//            // Populate the objects
//            $$name = new Modele();
//            $$name->setNomModele($modele["nom_modele"])
//                ->setRarete($modele["rarete"])
//                ->setPointNiv($modele["point_niv"])
//                ->setOuvrable($modele["ouvrable"]);
//            $manager->persist($$name);
//            $manager->flush();
//            $this->addReference($name, $$name);
//            //dump($name);
//            //dump($$name);
//        }
//    }
//}
//