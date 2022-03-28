<?php

namespace App\DataFixtures;

use App\Entity\Combat;
use DateTime;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CombatFixtures
extends Fixture
implements DependentFixtureInterface
{
    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getDependencies()
    {
        return [ScenarioFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $tabCombat = [
            ['Fichier log du combat 1', 'scenario5', 'USER_Matt'],
            ['Fichier log du combat 2', 'scenario4', 'USER_Joel'],
            ['Fichier log du combat 3', 'scenario3', 'admin'],
            ['Fichier log du combat 4', 'scenario2', 'USER_Yanis'],
            ['Fichier log du combat 5', 'scenario1', 'USER_Jacqueline'],

        ];

        $z = 0;
        foreach ($tabCombat as list($a, $b, $c)) {
            $z++;
            $combat = new Combat();
            $combat->setDateCombat(new DateTime('now'));
            $combat->setFichierLog($a);

            $combat->setLienScenario($this->getReference($b));
            $combat->setLienUser($this->getReference($c));

            $manager->persist($combat);
            $this->addReference('combat' . $z, $combat);
        }

        $manager->flush();
        unset($z, $a, $b, $c);
    }

    public function getOrder()
    {
        return 4;
    }
}
