<?php

namespace App\Controller;

use App\Repository\CreatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DatabaseTestsController extends AbstractController
{
    /**
     * @Route("/database/tests", name="app_database_tests")
     */
    public function index(CreatureRepository $creatureRepository): Response
    {

        $hotes = $creatureRepository->getFormationCreatures('DreamTeam');
        $monstres = $creatureRepository->getFormationCreatures('Nuisibles');

        // Ici tu peux formatter comme ceci
        $hotesIds = array_map(static fn ($value) => $value['id'], $hotes);
        $monstresIds = array_map(static fn ($value) => $value['id'], $monstres);

        //dump($hotesIds, $monstresIds);

        $hotesStats = [];
        $hotesStats[] = $creatureRepository->getStatsCreatures($hotesIds[0]);

        dump($hotesStats);

        $hotesActs = [];
        $hotesActs[] = $creatureRepository->getActionsCreatures($hotesIds[0]);

        dd($hotesActs);

        return $this->render('database_tests/index.html.twig', [
            'controller_name' => 'DatabaseTestsController',
        ]);
    }
}
