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

class MoteurCombatController extends AbstractController
{
    /**
     * @Route("/moteur/combat", name="app_moteur_combat")
     */
    public function MoteurTest(ManagerRegistry $doctrine): Response
    {
        $id = 1;
        $query = $doctrine->getRepository(Creature::class)->findAll();
        dd($query);
        $res = "";

        dd($res);
        return $this->render('moteur_combat/index.html.twig', [
            'controller_name' => 'MoteurCombatController',
        ]);
    }
}
