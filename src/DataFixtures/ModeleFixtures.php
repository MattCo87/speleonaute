<?php

namespace App\DataFixtures;

use App\Entity\Modele;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class ModeleFixtures
extends Fixture
implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $tabCharacModel = [
            ['Zabek', '1', '75', '1'],
            ['Cradou', '1', '35', '1'],
            ['Torti', '1', '60', '1'],
            ['Ecclès', '1', '80', '1'],
            ['Milly', '1', '50', '1'],
            ['Kaplopi', '1', '50', '1'],
            ['Pifou', '1', '35', '1'],
            ['Lovdisc', '1', '80', '1'],
            ['Holt', '1', '50', '1'],
            ['Prigun', '1', '50', '1'],
    
            // Character 10
            ['Rat des Mines', '5', '25', '1'],
            ['Ver Luisant', '5', '35', '1'],
            ['Chauve-souris Toxique', '5', '50', '1'],
            ['Salamandre Enragée', '5', '75', '1'],
            ['Mille-Pattes vénimeux', '5', '100', '1'],
            // Character 15
            ['Splinter', '10', '100',  '1'],
            ['Vertigo', '10', '100', '1'],
            ['Batboy', '10', '100', '1'],
            ['KingLouis', '10', '100', '1'],
            ['The Boss', '10', '100', '1'],
        ];

        $z = 0;
        foreach ($tabCharacModel as list($a, $b, $c, $d)) {
            $z++;
            $modele = new Modele();
            $modele->setnomModele($a);
            $modele->setrarete($b);
            $modele->setpointNiv($c);

            $modele->setouvrable($d);


            $manager->persist($modele);
            $this->addReference('modele' . $z, $modele);
        }

        $manager->flush();
        unset($z, $a, $b, $c, $d);
    }

    public function getOrder()
    {
        return 5;
    }
}
