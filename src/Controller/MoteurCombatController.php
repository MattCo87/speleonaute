<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoteurCombatController extends AbstractController
{
    /**
     * @Route("/moteur/combat", name="app_moteur_combat")
     */
    public function index(): Response
    {

        $res = array();

        dd($res);
        return $this->render('moteur_combat/index.html.twig', [
            'controller_name' => 'MoteurCombatController',
        ]);
    }
}
