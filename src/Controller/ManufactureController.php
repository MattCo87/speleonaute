<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @IsGranted("ROLE_USER")
 */
class ManufactureController extends AbstractController
{
    /**
     * @Route("/manufacture", name="app_manufacture")
     */
    public function index(): Response
    {
        return $this->render('manufacture/index.html.twig', [
            'controller_name' => 'ManufactureController',
        ]);
    }
}
