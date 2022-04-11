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
        $creatures["Milly"] = ["niveau" => 1, "experience" => 0, "nom" => "Milly", "idUser" => "USER_Matt", "idModele" => "MODEL_Araignedes"];
        $creatures["Eccles"] = ["niveau" => 1, "experience" => 0, "nom" => "Eccles", "idUser" => "USER_Matt", "idModele" => "MODEL_VerPsychiq"];
        $creatures["Zabek"] = ["niveau" => 1, "experience" => 0, "nom" => "Zabek", "idUser" => "USER_Matt", "idModele" => "MODEL_Rejetonde"];
        $creatures["Cradou"] = ["niveau" => 1, "experience" => 0, "nom" => "Cradou", "idUser" => "USER_Matt", "idModele" => "MODEL_Cubegelati"];
        $creatures["Torti"] = ["niveau" => 1, "experience" => 0, "nom" => "Torti", "idUser" => "USER_Matt", "idModele" => "MODEL_Basilicgea"];
        $creatures["Rat sanguinaire 1"] = ["niveau" => 1, "experience" => 0, "nom" => "Rat sanguinaire 1", "idUser" => "admin", "idModele" => "MODEL_Ratsanguin"];
        $creatures["Rat sanguinaire 2"] = ["niveau" => 1, "experience" => 0, "nom" => "Rat sanguinaire 2", "idUser" => "admin", "idModele" => "MODEL_Ratsanguin"];
        $creatures["Rat sanguinaire 3"] = ["niveau" => 1, "experience" => 0, "nom" => "Rat sanguinaire 3", "idUser" => "admin", "idModele" => "MODEL_Ratsanguin"];
        $creatures["Ver toxique 1"] = ["niveau" => 1, "experience" => 0, "nom" => "Ver toxique 1", "idUser" => "admin", "idModele" => "MODEL_Vertoxique"];
        $creatures["Ver toxique 2"] = ["niveau" => 1, "experience" => 0, "nom" => "Ver toxique 2", "idUser" => "admin", "idModele" => "MODEL_Vertoxique"];
        $creatures["Guepe venimeuse geante 1"] = ["niveau" => 1, "experience" => 0, "nom" => "Guêpe venimeuse géante 1", "idUser" => "admin", "idModele" => "MODEL_Guepeveni"];
        $creatures["Guepe venimeuse geante 2"] = ["niveau" => 1, "experience" => 0, "nom" => "Guêpe venimeuse géante 2", "idUser" => "admin", "idModele" => "MODEL_Guepeveni"];
        $creatures["Guepe venimeuse geante 3"] = ["niveau" => 1, "experience" => 0, "nom" => "Guêpe venimeuse géante 3", "idUser" => "admin", "idModele" => "MODEL_Guepeveni"];
        $creatures["Dragon blanc au yeux bleu"] = ["niveau" => 1, "experience" => 0, "nom" => "Dragon blanc au yeux bleu", "idUser" => "admin", "idModele" => "MODEL_Dragonbla"];


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
