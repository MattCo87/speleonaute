<?php

namespace App\Controller;

use App\Entity\PageVisiteur;
use App\Repository\CreatureRepository;
use App\Repository\ModeleRepository;
use App\Repository\StatistiqueCreatureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\Security\Core\Security;
/**
 * @IsGranted("ROLE_USER")
 */
class HubController extends AbstractController
{
    private $security;
    private $emm;
    private $emc;
    private $emsc;

    function __construct(Security $security, CreatureRepository $emc, ModeleRepository $emm, StatistiqueCreatureRepository $emsc)
    {
        $this->security = $security;
        $this->emm = $emm;
        $this->emc = $emc;
        $this->emsc = $emsc;
    }

    /**
     * @Route("/hub", name="app_hub")
     */
    public function index(): Response
    {
        $temp_user = $this->security->getUser();
        $var_user = $temp_user->getId();
        //dd($temp_user);

        return $this->render('hub/hub_accueil.html.twig', [
            'profil'    => $temp_user,
            'controller_name' => 'HubController',
        ]);
    }

    /**
     * @Route("/hub/regles", name="app_hub_regles")
     */
    public function reglesHub(ManagerRegistry $doctrine): Response
    {
        $page = [];
        $page = $doctrine->getRepository(PageVisiteur::class)->findOneBy(['titre' => 'Règles']);
        //dd($page);
        return $this->render('hub/regles_hub.html.twig', [
            'regles' => $page,
            'controller_name' => 'HubController',
        ]);
    }

    /**
     * @Route("/hub/glossaire", name="app_hub_glossaire")
     */
    public function glossaireHub(ManagerRegistry $doctrine): Response
    {
        $page = [];
        $page = $doctrine->getRepository(PageVisiteur::class)->findOneBy(['titre' => 'Glossaire']);
        //dd($page);
        return $this->render('hub/glossaire_hub.html.twig', [
            'glossaire' => $page,
            'controller_name' => 'HubController',
        ]);
    }

    /**
     * @Route("/creature", name="app_creature")
     */
    public function createCreature(): Response
    {
        // Je choisis un modèle au hasard
        $modele = $this->emm->find(rand(1, 7));

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
