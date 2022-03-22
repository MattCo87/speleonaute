<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    /**
     * @Route("/mentions-legales", name="app_mentions_legales")
     */
    public function mentionslegales(): Response
    {
        return $this->render('public/mentionlegales.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
    /**
     * @Route("/glossaire", name="app_glossaire")
     */
    public function glossaire(): Response
    {
        return $this->render('public/glossaire.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
    /**
     * @Route("/regles", name="app_regles")
     */
    public function regles(): Response
    {
        return $this->render('public/regles.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
    /**
     * @Route("/team", name="app_team")
     */
    public function team(): Response
    {
        return $this->render('public/team.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
}
