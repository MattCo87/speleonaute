<?php

namespace App\Controller;

use App\Form\HotelVentesType;
use App\Service\MoteurCombatService2;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @IsGranted("ROLE_USER")
 */
class HotelVentesController extends AbstractController
{

    private $security;

    public function __construct(Security $security, EntityManagerInterface $manager)
    {
        $this->security = $security;
        $this->manager = $manager;
    }



    /**
     * @Route("/hotel-ventes", name="app_hotel_ventes")
     */
    public function index(Request $request, MoteurCombatService2 $moteurCombatService): Response
    {
        $temp_user = $this->security->getUser();
        $user = $this->security->getUser();
        $tab = array();
        $form = $this->createForm(HotelVentesType::class,$tab);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            if($user->getMonnaie()<1000){
                $this->addFlash(
                    'notice',
                    "Tu n'a pas assez d'argent"
                );
                return $this->redirectToRoute('app_hotel_ventes');
            }

            $moteurCombatService->Creationhote($user);
                $this->addFlash(
                    'notice',
                    "Merci pour votre achat, un hote a etait envoyé à votre entrepot"
                );
                $monnaie = $user->getMonnaie() -1000;
                $user->setMonnaie($monnaie);
                $this->manager->persist($user);
                $this->manager->flush();

                return $this->redirectToRoute('app_hotel_ventes');
        }
//        dd($form);

        return $this->render('hotel_ventes/index.html.twig', [
            'profil' => $temp_user,
            'joueur' => $user,
            'HVform' => $form->createView(),
            'controller_name' => 'HotelVentesController',
        ]);
    }
}
