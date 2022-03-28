<?php

namespace App\DataFixtures;

use App\Entity\Creature;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CreatureFixtures
extends Fixture
implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tabCharacModel = [
            ['Zabek', '1', '75', 'USER_Yanis', 'modele1'],
            ['Cradou', '1', '35', 'USER_Yanis', 'modele2'],
            ['Torti', '1', '60', 'USER_Yanis', 'modele3'],
            ['Ecclès', '1', '80', 'USER_Yanis', 'modele4'],
            ['Milly', '1', '50', 'USER_Yanis', 'modele5'],
            ['Kaplopi', '1', '50', 'USER_Joel', 'modele6'],
            ['Pifou', '1', '35', 'USER_Joel', 'modele7'],
            ['Lovdisc', '1', '80', 'USER_Joel', 'modele8'],
            ['Holt', '1', '50', 'USER_Joel', 'modele9'],
            ['Prigun', '1', '50', 'USER_Joel', 'modele10'],

            ['Rat des Mines', '5', '25', 'admin', 'modele11'],
            ['Ver Luisant', '5', '35', 'admin', 'modele12'],
            ['Chauve-souris Toxique', '5', '50', 'admin', 'modele13'],
            ['Salamandre Enragée', '5', '75', 'admin', 'modele14'],
            ['Mille-Pattes vénimeux', '5', '100', 'admin', 'modele15'],

            ['Splinter', '10', '100',  'admin', 'modele16'],
            ['Vertigo', '10', '100', 'admin', 'modele17'],
            ['Batboy', '10', '100', 'admin', 'modele18'],
            ['KingLouis', '10', '100', 'admin', 'modele19'],
            ['The Boss', '10', '100', 'admin', 'modele20'],
        ];

        $z = 0;
        foreach ($tabCharacModel as list($a, $b, $c, $d, $e)) {
            $z++;
            $creature = new Creature();
            $creature->setNom($a);
            $creature->setNiveau($b);
            $creature->setExp($c);

            $creature->setLienUser($this->getReference($d));
            $creature->setLienModele($this->getReference($e));


            $manager->persist($creature);
            $this->addReference('creature' . $z, $creature);
        }

        $manager->flush();
        unset($z, $a, $b, $c, $d, $e);
    }

    public function getOrder()
    {
        return 6;
    }
}
