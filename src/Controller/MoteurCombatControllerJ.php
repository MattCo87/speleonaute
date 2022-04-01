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
     * @Route("/moteur/combat", name="app_moteur_combat_J")
     */
    public function moteurCombat(CreatureRepository $creatureRepository): Response
    {
        $hotes = $creatureRepository->getFormationCreatures('DreamTeam');
        $monstres = $creatureRepository->getFormationCreatures('Nuisibles');

        // Ici tu peux formatter comme ceci
        $hotesIds = array_map(static fn ($value) => $value['id'], $hotes);
        $monstresIds = array_map(static fn ($value) => $value['id'], $monstres);

        dd($hotesIds, $monstresIds);

        return $this->render('moteur_combat/index.html.twig', [
            'controller_name' => 'MoteurCombatController',
        ]);
    }
