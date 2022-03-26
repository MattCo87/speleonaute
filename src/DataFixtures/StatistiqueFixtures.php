<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Implémentation d'une méthode pour déclarer les fixtures dont celle-ci dépend 
// Et qu'il faut lancer avant elle
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Statistique;


class StatistiqueFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [UserFixtures::class];
    }

    // Chargement de l'objet provenant de l'Entity
    public function load(ObjectManager $manager): void
    {

        $statToucher = new Statistique();
        // Méthodes propres à l'Entity
        $statToucher->setNom("Toucher");
        $manager->persist($statToucher);
        $manager->flush();
        // Ajoute l'objet pour les autres fichiers de fixtures
        $this->addReference("StatToucher", $statToucher);

        $statDegat = new Statistique();
        $statDegat->setNom("Degat");
        $manager->persist($statDegat);
        $manager->flush();
        $this->addReference("StatDegat", $statDegat);

        $statResistance = new Statistique();
        $statResistance->setNom("Resistance");
        $manager->persist($statResistance);
        $manager->flush();
        $this->addReference("StatResistance", $statResistance);

        $statVitesse = new Statistique();
        $statVitesse->setNom("Vitesse");
        $manager->persist($statVitesse);
        $manager->flush();
        $this->addReference("StatVitesse", $statVitesse);

        $statEndurance = new Statistique();
        $statEndurance->setNom("Endurance");
        $manager->persist($statEndurance);
        $manager->flush();
        $this->addReference("StatEndurance", $statEndurance);
    }
}
