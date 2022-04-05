<?php

namespace App\Controller;

use App\Repository\CreatureRepository;
use App\Repository\StatistiqueCreatureRepository;
use App\Entity\Creature;

use App\Repository\ModeleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HubController extends AbstractController
{

    private $emm;
    private $emc;
    private $emsc;

    function __construct(CreatureRepository $emc, ModeleRepository $emm, StatistiqueCreatureRepository $emsc)
    {
        $this->emm = $emm;
        $this->emc = $emc;
        $this->emsc = $emsc;
    }

    /**
     * @Route("/hub", name="app_hub")
     */
    public function index(): Response
    {
        return $this->render('hub/index.html.twig', [
            'controller_name' => 'HubController',
        ]);
    }


    /**
     * @Route("/creature", name="app_creature")
     */
    public function createCreature(): Response
    {
        // Je choisis un modèle au hasard
        $modele = $this->emm->find(rand(1,7));

        // Je crée une nouvelle créature
        $creature = $this->emc->makeCreature($modele);

        // Je récupére les statistiques de la nouvelle créature
        $statcreature = $this->emsc->findBy(['lienCreature' => $creature->getId()]);

        return $this->render('hub/creature.html.twig', [
            'creature' => $creature,
            'statcreature' => $statcreature,
        ]);
    }
}
