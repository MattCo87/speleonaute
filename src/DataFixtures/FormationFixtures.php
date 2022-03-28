<?php

namespace App\DataFixtures;

use App\Entity\Formation;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class FormationFixtures
extends Fixture
implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 11;
    }

    public function load(ObjectManager $manager): void
    {

        // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante


        $tabFormation = [
            ['Explorers', 'admin'],
            ['Bersekers', 'admin'],
            ['Snipers', 'admin'],
            ['ArcheoWinners', 'admin'],
            ['JYM', 'admin'],
            ['SpeleoBoyz', 'USER_Matt'],
            ['CasseurBrickerz', 'USER_Matt'],
            ['TeamYanis', 'USER_Yanis'],
            ['SuperTeamYanis', 'USER_Yanis'],
            ['TeamJoel', 'USER_Joel'],
            ['SuperTeamJoel', 'USER_Joel'],
        ];

        $z = 0;
        foreach ($tabFormation as list($a, $b)) {
            $z++;
            $formation = new Formation();
            $formation->setNom($a);

            if ($b) {
                $formation->setLienUser($this->getReference($b));
            }

            $manager->persist($formation);
            $this->addReference('formation' . $z, $formation);
        }

        $manager->flush();
        unset($z, $a);
    }
}
