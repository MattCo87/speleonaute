<?php

namespace App\Controller;

use App\Entity\CreatureFormation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CreatureFormationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="app_formation")
     */
    public function index(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager): Response
    {
        // On crée une CreatureFormation
        $creatureFormation = new CreatureFormation();

        //On crée le formulaire de création de CreatureFormation
        $form = $this->createForm(CreatureFormationType::class, $creatureFormation);
        $form->handleRequest($request);
        
        // Action sur la validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // On ajoute la CreatureFormation 
            $manager->persist($creatureFormation);
            $manager->flush();

            return $this->redirectToRoute('app_formation');
        }
        
        return $this->render('formation/index.html.twig', [
            'form' => $form->createView(),           
        ]);
    }
}
