<?php

namespace App\Controller;

use App\Entity\Combat;
use App\Entity\Formation;
use App\Form\ChevallementType;
use App\Form\ChevallementType2;
use App\Entity\Scenario;
use App\Entity\User;
use App\Service\MoteurCombatService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security as CoreSecurity;

class ChevallementController extends AbstractController
{

    private $security;

    public function __construct(CoreSecurity $security, ManagerRegistry $registry)
    {
        $this->security = $security;
        $this->registry = $registry;
    }

    /**
     * @Route("/chevallement", name="app_chevallement")
     */
    /*public function index(): Response
    {
        return $this->render('chevallement/index.html.twig', [
            'controller_name' => 'ChevallementController',
        ]);
    }*/
    public function index(ManagerRegistry $doctrine,Request $request, ValidatorInterface $validator, EntityManagerInterface $manager, MoteurCombatService $moteurCombatService): Response
    {
        // On crée une CreatureFormation
    $combat = new Combat();
    $formation = new Formation();
    $scenario = new Scenario();
    $tab =array();
        //dd(1);
        $user = $this->security->getUser();
       // $tab['lienScenario']->setLienUser($user);

       // dd($user);
        //dd($user);
        //$combat->setLienUser() = $user;
        //On crée le formulaire de création de CreatureFormation
        //$form = $this->createForm(ChevallementType::class, $combat, ['arg1' => $formation]);
        $form = $this->createForm(ChevallementType::class, $tab);
        //dd($form->getData()->getLienUser());
        
        $form->handleRequest($request);
        //$form->setLienUser($user);
        $formation = $form['lienUser']->getData();
        $scenario = $form['lienScenario']->getData();
        $combat->setLienUser($user);
        $combat->setLienScenario($scenario);
        $combat->setDateCombat(new \DateTime('now'));
        $combat->setFichierLog('');

        //dd($form['lienUser']->getData()->getnom(),$form['lienScenario']->getData()->getnom());
        //dd($combat,$scenario,$formation);
        //dd($formation,$scenario);
        
        // Action sur la validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // On ajoute la CreatureFormation 
            $manager->persist($combat);
            //dd($combat,$scenario,$formation);
            $manager->flush();
            //dd($combat,$scenario,$formation);
            $idCombat = $combat->getId();
            $letsGO = $moteurCombatService->combat($doctrine,$formation, $scenario,$idCombat);

            return $this->redirectToRoute('app_chevallement');
        }
        
        return $this->render('chevallement/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'ChevallementController',           
        ]);
    }
}
