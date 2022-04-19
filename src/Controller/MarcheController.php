<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @IsGranted("ROLE_USER")
 */
class MarcheController extends AbstractController
{
    /**
     * @Route("/marche", name="app_marche")
     */
    public function index(): Response
    {
        return $this->render('marche/index.html.twig', [
            'controller_name' => 'MarcheController',
        ]);
    }
}
