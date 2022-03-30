<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequeteController extends AbstractController
{
    /**
     * @Route("/requete", name="app_requete")
     */
    public function index(): Response
    {
        return $this->render('requete/index.html.twig', [
            'controller_name' => 'RequeteController',
        ]);
    }
}
