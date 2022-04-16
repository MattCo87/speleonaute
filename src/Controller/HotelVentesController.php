<?php

namespace App\Controller;

use App\Form\HotelVentesType;
use App\Service\MoteurCombatService2;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelVentesController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }



    /**
     * @Route("/hotel-ventes", name="app_hotel_ventes")
     */
    public function index(Request $request, MoteurCombatService2 $moteurCombatService): Response
    {

        $user = $this->security->getUser();
        $tab = array();
        $form = $this->createForm(HotelVentesType::class,$tab);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moteurCombatService->Creationhote($user);
                $this->addFlash(
                    'notice',
                    "hote bien créer"
                );
                return $this->redirectToRoute('app_hotel_ventes');
        }
//        dd($form);

        return $this->render('hotel_ventes/index.html.twig', [
            'HVform' => $form->createView(),
            'controller_name' => 'HotelVentesController',
        ]);
    }
}
