<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use App\Repository\CreatureRepository;
use App\Entity\Creature;
use App\Repository\FormationRepository;

class MoteurCombatController extends AbstractController
{
    /**
     * @Route("/moteur/combat", name="app_moteur_combat")
     */
    public function MoteurTest(CreatureRepository $formationCreatures): Response
    {
        $formation = "Nuisibles";
        $ennemies = $formationCreatures->getFormationCreatures($formation);

        dd($ennemies);
        return $this->render('moteur_combat/index.html.twig', [
            'controller_name' => 'MoteurCombatController',
        ]);
    }
}
