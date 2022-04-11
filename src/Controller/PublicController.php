<?php

namespace App\Controller;

use App\Entity\PageVisiteur;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    /**
     * @Route("/mentions-legales", name="app_mentions_legales")
     */
    public function mentionslegales(ManagerRegistry $doctrine): Response
    {
        $page = new PageVisiteur();
        $page = $doctrine->getRepository(PageVisiteur::class)->findOneBy(['titre' => 'Mentions Légales']);
        //dd($page);
        return $this->render('public/mentionslegales.html.twig', [
            'mentionsLegales' => $page,
            'controller_name' => 'PublicController',
        ]);
    }
    /**
     * @Route("/glossaire", name="app_glossaire")
     */
    public function glossaire(ManagerRegistry $doctrine): Response
    {
        $page = new PageVisiteur();
        $page = $doctrine->getRepository(PageVisiteur::class)->findOneBy(['titre' => 'Glossaire']);

        return $this->render('public/glossaire.html.twig', [
            'glossaire' => $page,
            'controller_name' => 'PublicController',
        ]);
    }
    /**
     * @Route("/regles", name="app_regles")
     */
    public function regles(ManagerRegistry $doctrine): Response
    {
        $page = new PageVisiteur();
        $page = $doctrine->getRepository(PageVisiteur::class)->findOneBy(['titre' => 'Règles']);

        return $this->render('public/regles.html.twig', [
            'regles' => $page,
            'controller_name' => 'PublicController',
        ]);
    }
    /**
     * @Route("/team", name="app_team")
     */
    public function team(ManagerRegistry $doctrine): Response
    {
        $page = new PageVisiteur();
        $page = $doctrine->getRepository(PageVisiteur::class)->findOneBy(['titre' => 'Team']);

        return $this->render('public/team.html.twig', [
            'team' => $page,
            'controller_name' => 'PublicController',
        ]);
    }
}
