<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use App\Entity\Formation;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class FormationFixtures extends Fixture implements OrderedFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getOrder()
    {
        return 11;
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {
        $formations = array();
        // Create the entries
        $formations["FORM_Nuisibles1"] = ["nom" => "Nuisibles", "idUser" => "USER_Admin"];
        $formations["FORM_DreamTeam2"] = ["nom" => "DreamTeam", "idUser" => "USER_Joueur"];
        $formations["FORM_Venimeuse3"] = ["nom" => "Venimeuse", "idUser" => "USER_Admin"];
        $formations["FORM_Boss4"] = ["nom" => "Boss", "idUser" => "USER_Admin"];

        foreach ($formations as $name => $formation) {
            // Populate the objects
            $$name = new Formation();
            $$name->setNom($formation["nom"])
                ->setLienUser($this->getReference($formation["idUser"]));
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
        $manager->flush();
    }
}
