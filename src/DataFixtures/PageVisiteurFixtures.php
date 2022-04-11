<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\PageVisiteur;

class PageVisiteurFixtures extends Fixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 14;
    }

    public function load(ObjectManager $manager): void
    {

        $pages = array();

        // Create the entries
        $pages["PG_Glossaire"] = ["titre" => "Glossaire", "contenu" =>
        <<<HTML
        <h1>Glossaire</h1>
        <h2>Hôte</h2>
        <P>Ce sont des monstres de la Fosse, mais "apprivoisés" et accoutumés à la vie à la surface grâce à un greffon.</p>
        <h2>Monstre</h2>
        <P>Ce sont les habitants de la Fosse. Il y en a de toutes les sortes, notamment à cause du courant, qui permet à la lumière de pénétrer très profondément dans la Fosse et donc de recréer des habitats entiers propres à leur croissance.</p>
        <h2>Chevalement</h2>
        <P>On ne peut pas le rater, il s'agit de la grande construction au-dessus de la Fosse. Hobb, son maître, décide à quel niveau vous avez droit d'aller. C'est lui qui gère les treuils qui envoient et remontent les cages d'exploration.</p>
        HTML];
        $pages["PG_mentionslegales"] = [
            "titre" => "Mentions Légales", "contenu" =>
            <<<HTML
        <h1>Mentions légales</h1>
        <p>Merci de lire avec attention les différentes modalités d’utilisation du présent site avant d’en parcourir les pages. En vous connectant sur ce site, vous acceptez sans réserves les présentes modalités.</p>
        <p>Aussi, conformément à l’article n°6 de la Loi n°2004-575 du 21 Juin 2004 pour la confiance dans l’économie numérique, les responsables du présent site internet www.speleonautes.fr sont :</p>
            <h2>Éditeur du Site :<h2>
            <p>Nom : Joel Yanis Matthieu Prénom : JYM Limoges Email : speleonautes@gmail.com Site Web : www.speleonautes.fr</p>
            <h2>Hébergement :</h2>
            <p>Hébergeur : Serveur Labas Limoges Site Web : www.labas.fr</p>
            <h2>Développement :</h2>
            <p>Joel Yanis Matthieu Adresse : Limoges Site Web : www.JoelYanisMatthieu.fr</p>
            <h2>Conditions d’utilisation :</h2>
            <p>Dans ce cas, vous ne pourrez pas utiliser les services du site, notamment celui de solliciter des renseignements sur nos activités, ou de recevoir les lettres d’information. Enfin, nous pouvons collecter de manière automatique certaines informations vous concernant lors d’une simple navigation sur notre site Internet, notamment : des informations concernant l’utilisation de notre site, comme les zones que vous visitez et les services auxquels vous accédez, votre adresse IP, le type de votre navigateur, vos temps d'accès. De telles informations sont utilisées exclusivement à des fins de statistiques internes, de manière à améliorer la qualité des services qui vous sont proposés. Les bases de données sont protégées par les dispositions de la loi du 1er juillet 1998 transposant la directive 96/9 du 11 mars 1996 relative à la protection juridique des bases de données. </p>
        HTML
        ];
        $pages["PG_regles"] = [
            "titre" => "Règles", "contenu" =>
            <<<HTML
        <h1>Règles du jeu</h1>
        <h2>Comment y jouer ?</h2>
        <P>Le jeu consiste à sélectionner une équipe d'hôtes, en fonction des actions et stratégies propres à chaque hôte, puis de les envoyer affronter, dans la Fosse, des hordes de monstres. Le combat est automatique, et vous aurez accès une fois fini à un log détaillé permettant de comprendre ce qui s'est passé.</p>
        <p>Vous ne perdrez pas vos hôtes, ils seront secourus une fois arrivés à 0 points de vie, et, moyennant un temps d'attente, ils seront à nouveau prêts pour être envoyés à un aute combat.</p>
        <h2>Stratégies</h2>
        <p>Le jeu consiste à choisir les bons hôtes à envoyer au combat, selon les monstres qu'ils auront à affronter, et leurs stratégies. Il est souvent nécessaire d'envoyer une première fois une équipe pour voir comment les monstres opèrent et en déduire, lors d'un second combat, votre stratégie.</p>
        <h2>Évolution</h2>
        <p>Au fur et à mesure des combats, vos hôtes vont gagner en expérience et évoluer, mais aussi vous aller accéder à plus d'hôtes, qui vous permettront de faire plusieurs combats en parallèle.</p>
        <p>Avec votre progression, vous allez pouvoir accéder à des niveaux différents de la Fosse, qui mettront plus de temps à atteindre, mais aussi rapporteront bien plus que les niveaux proches de la surface.</p>
        HTML
        ];
        $pages["PG_team"] = [
            "titre" => "Team", "contenu" =>
            <<<HTML
        <p><strong>Yanis</strong> : l'idée originale vient d'un jeu auquel il a beaucoup joué, aujourd'hui disparu ! Le moteur de combat, c'est lui.</p>
        <p><strong>Matthieu</strong> : Notre référent technique en Symfony, toujours prêt pour un petit <code>php bin/console</code> !</p>
        <p><strong>Joël</strong> : Sa passion pour <em>Made in Abyss</em> lui a donné envie de créer un univers parallèle avec une Fosse et des monstres ;)</p>
        HTML
        ];

        foreach ($pages as $name => $page) {
            // Populate the objects
            $$name = new PageVisiteur();
            $$name->setTitre($page["titre"])
                ->setContenu($page["contenu"]);
            $manager->persist($$name);
            $this->addReference($name, $$name);
            //dump($name);
            //dump($$name);
        }
        $manager->flush();
    }
}

// Ancien mécanisme de génération d'actions par tier (ActionFIxtures.php ActionStrategieFixtures.php et StrategieFixtures.php)
//
//class ActionFixtures extends Fixture implements OrderedFixtureInterface
//{
//    public function getOrder()
//    {
//        return 2;
//    }
//
//    public function load(ObjectManager $manager): void
//    {
//
//        $actions = array();
//        for ($i = 1; $i < 4; $i++) {
//            // Create the entries
//            $actions["ACT_Eternuement" . $i] = ["nom" => "Éternuement force $i", "toucher" => $i * 1, "degat" => $i * 1, "tier" => 1];
//            $actions["ACT_Frappe" . $i] = ["nom" => "Frappe force $i", "toucher" => $i * 1 + 1, "degat" => $i * 1 + 1, "tier" => 1];
//            $actions["ACT_Roulement" . $i] = ["nom" => "Frappe roulée force $i", "toucher" => $i * 2 + 1, "degat" => $i * 2 + 1, "tier" => 2];
//            $actions["ACT_Poison" . $i] = ["nom" => "Poison force $i", "toucher" => $i * 3, "degat" => $i * 3, "tier" => 3];
//            $actions["ACT_Magie" . $i] = ["nom" => "Magie force $i", "toucher" => $i * 3, "degat" => $i * 3, "tier" => 3];
//            $actions["ACT_Effondrement" . $i] = ["nom" => "Effondrement force $i", "toucher" => $i * 3 + 1, "degat" => $i * 3 + 1, "tier" => 3];
//        }
//
//        foreach ($actions as $name => $action) {
//            // Populate the objects
//            $$name = new Action();
//            $$name->setNom($action["nom"])
//                ->setToucher($action["toucher"])
//                ->setDegat($action["degat"])
//                ->setTier($action["tier"]);
//            $manager->persist($$name);
//            $manager->flush();
//            $this->addReference($name, $$name);
//            //dump($name);
//            //dump($$name);
//        }
//    }
//}
//