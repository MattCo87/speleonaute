<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Modele;
use phpDocumentor\Reflection\PseudoTypes\False_;

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
            $modeles["Ratus" . $i] = ["nom_modele" => "Rat des cavernes de niveau $i", "rarete" => "$i", "point_niv" => "$i", "ouvrable" => TRUE];
            $modeles["Chiroptera" . $i] = ["nom_modele" => "Chiroptère de niveau $i", "rarete" => "$i", "point_niv" => "$i", "ouvrable" => TRUE];
            $modeles["Boa" . $i] = ["nom_modele" => "Boa cavernicole de niveau $i", "rarete" => "$i", "point_niv" => "$i", "ouvrable" => TRUE];
            $modeles["Dionea" . $i] = ["nom_modele" => "Dionée mutante de niveau $i", "rarete" => "$i", "point_niv" => "$i", "ouvrable" => TRUE];
            $modeles["Myriapode" . $i] = ["nom_modele" => "Myriapode venimeux de niveau $i", "rarete" => "$i", "point_niv" => "$i", "ouvrable" => TRUE];
            $modeles["Myriapode" . $i] = ["nom_modele" => "Myriapode venimeux de niveau $i", "rarete" => "$i", "point_niv" => "$i", "ouvrable" => TRUE];
            $modeles["Mammoth" . $i] = ["nom_modele" => "Éléphant cavernicole", "rarete" => "5", "point_niv" => "6", "ouvrable" => FALSE];
        }
        foreach ($modeles as $name => $modele) {
            // Populate the objects
            $$name = new Modele();
            $$name->setNom($modele["nom_modele"]);
            $manager->persist($$name);
            $manager->flush();
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
    }
}
