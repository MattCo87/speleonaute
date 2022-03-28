<?php

namespace App\DataFixtures;

use App\Entity\Scenario;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\Dep;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ScenarioFixtures
extends Fixture
implements DependentFixtureInterface
{

    // Remplacer "UserFixtures" avec la classe dont celle-ci est dépendante
    public function getDependencies()
    {
        return [FormationFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        $tabScenario = [
            ['Scénario 1', 'Le premier scénario', '100', 'formation1'],
            ['Scénario 2', 'Le deuxième scénario', '250', 'formation3'],
            ['Scénario 3', 'Le troisième scénario', '500', 'formation6'],
            ['Scénario 4', 'Le quatrième scénario', '750', 'formation9'],
            ['Scénario 5', 'Le cinquième scénario', '1000', 'formation11'],

        ];

        $z = 0;
        foreach ($tabScenario as list($a, $b, $c, $d)) {
            $z++;
            $scenario = new Scenario();
            $scenario->setNom($a);
            $scenario->setDescription($b);
            $scenario->setRecompense($c);

            $scenario->setLienFormation($this->getReference($d));


            $manager->persist($scenario);
            $this->addReference('scenario' . $z, $scenario);
        }

        $manager->flush();
        unset($z, $a, $b, $c, $d);
    }
}
