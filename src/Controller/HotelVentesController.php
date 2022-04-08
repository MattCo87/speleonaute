<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelVentesController extends AbstractController
{
    /**
     * @Route("/hotel/ventes", name="app_hotel_ventes")
     */
    public function index(): Response
    {
        return $this->render('hotel_ventes/index.html.twig', [
            'controller_name' => 'HotelVentesController',
        ]);
    }
}
