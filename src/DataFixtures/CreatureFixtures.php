<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Creature;

class CreatureFixtures extends Fixture implements OrderedFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getOrder()
    {
        return 9;
    }

    public function load(ObjectManager $manager): void
    {

        $creatures = array();

        // Create the entries
        $creatures["Milly21"] = ["niveau" => 1, "experience" => 0, "nom" => "Milly", "idUser" => "USER_Matt", "idModele" => "MODEL_Araignedes"];
        $creatures["Eccles22"] = ["niveau" => 1, "experience" => 0, "nom" => "Eccles", "idUser" => "USER_Matt", "idModele" => "MODEL_VerPsychiq"];
        $creatures["Zabek23"] = ["niveau" => 1, "experience" => 0, "nom" => "Zabek", "idUser" => "USER_Matt", "idModele" => "MODEL_Rejetonde"];
        $creatures["Cradou24"] = ["niveau" => 1, "experience" => 0, "nom" => "Cradou", "idUser" => "USER_Matt", "idModele" => "MODEL_Cubegelati"];
        $creatures["Torti25"] = ["niveau" => 1, "experience" => 0, "nom" => "Torti", "idUser" => "USER_Matt", "idModele" => "MODEL_Basilicgea"];
        $creatures["Rat sanguinaire16"] = ["niveau" => 1, "experience" => 0, "nom" => "Rat sanguinaire", "idUser" => "admin", "idModele" => "MODEL_Ratsanguin"];
        $creatures["Ver toxique17"] = ["niveau" => 1, "experience" => 0, "nom" => "Ver toxique    ", "idUser" => "admin", "idModele" => "MODEL_Vertoxique"];


        foreach ($creatures as $name => $creature) {
            // Populate the objects
            $$name = new Creature();
            $$name->setNom($creature["nom"])
                ->setNiveau($creature["niveau"])
                ->setExp($creature["experience"])
                ->setLienModele($this->getReference($creature["idModele"]))
                ->setLienUser($this->getReference($creature["idUser"]));
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }

        $manager->flush();
    }
}
