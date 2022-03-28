<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Modele;

class ModeleFixtures extends Fixture implements DependentFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getDependencies()
    {
        return [UserFixtures::class];
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $modeles = array();
        for ($i = 1; $i <= 2; $i++) {
            // Create the entries
            $modeles["MODEL_Ratus" . $i] = ["nom_modele" => "Rat des cavernes de niveau $i", "rarete" => $i, "point_niv" => $i, "ouvrable" => TRUE];
            $modeles["MODEL_Chiroptera" . $i] = ["nom_modele" => "Chiroptère de niveau $i", "rarete" => $i, "point_niv" => $i, "ouvrable" => TRUE];
            $modeles["MODEL_Boa" . $i] = ["nom_modele" => "Boa cavernicole de niveau $i", "rarete" => $i + 2, "point_niv" => $i + 2, "ouvrable" => TRUE];
            $modeles["MODEL_Dionea" . $i] = ["nom_modele" => "Dionée mutante de niveau $i", "rarete" => $i + 1, "point_niv" => $i, "ouvrable" => TRUE];
            $modeles["MODEL_Myriapode" . $i] = ["nom_modele" => "Myriapode venimeux de niveau $i", "rarete" => $i, "point_niv" => $i, "ouvrable" => TRUE];
            $modeles["MODEL_Amphibia" . $i] = ["nom_modele" => "Salamandre venimeuse de niveau $i", "rarete" => $i + 1, "point_niv" => $i + 1, "ouvrable" => TRUE];
            $modeles["MODEL_Megatherium"] = ["nom_modele" => "Paresseux cavernicole des temps anciens", "rarete" => "5", "point_niv" => "6", "ouvrable" => FALSE];
            $modeles["MODEL_Behemoth"] = ["nom_modele" => "Monstre aquatique profond", "rarete" => "5", "point_niv" => "6", "ouvrable" => FALSE];
            $modeles["MODEL_Leviathan"] = ["nom_modele" => "Céphalopode géant des profondeurs", "rarete" => "5", "point_niv" => "6", "ouvrable" => FALSE];
            $modeles["MODEL_Abomination"] = ["nom_modele" => "Cthulhu R'lyeh wgah'nagl fhtagn", "rarete" => "5", "point_niv" => "6", "ouvrable" => FALSE];
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
