<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChevallementController extends AbstractController
{
    /**
     * @Route("/chevallement", name="app_chevallement")
     */
    public function index(): Response
    {
        return $this->render('chevallement/index.html.twig', [
            'controller_name' => 'ChevallementController',
        ]);
    }
}
