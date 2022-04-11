<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepotController extends AbstractController
{
    /**
     * @Route("/entrepot", name="app_entrepot")
     */
    public function index(): Response
    {
        return $this->render('entrepot/index.html.twig', [
            'controller_name' => 'EntrepotController',
        ]);
    }
}
