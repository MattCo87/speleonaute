<?php

namespace App\Controller;

use App\Entity\Combat;
use App\Entity\CreatureFormation;
use App\Entity\Formation;
use App\Form\ChevalementType;
use App\Entity\Scenario;
use App\Entity\User;
use App\Service\MoteurCombatService2;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security as CoreSecurity;

class ChevalementController extends AbstractController
{

    private $security;

    public function __construct(CoreSecurity $security, ManagerRegistry $registry)
    {
        $this->security = $security;
        $this->registry = $registry;
    }

    /**
     * @Route("/chevalement", name="app_chevalement")
     */
    public function index(Request $request, EntityManagerInterface $manager, MoteurCombatService2 $moteurCombatService): Response
    {
        // On crée un Combat
        $combat = new Combat();
        $formation = new Formation();
        $scenario = new Scenario();
        $tab =array();
        $user = $this->security->getUser();
        $form = $this->createForm(ChevalementType::class, $tab);
        $form->handleRequest($request);
        $formation = $form['lienUser']->getData();
        $scenario = $form['lienScenario']->getData();
        $combat->setLienUser($user);
        $combat->setLienScenario($scenario);
        $combat->setDateCombat(new \DateTime('now'));
        $combat->setFichierLog('');
        // Action sur la validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $tiersCrea = $this->registry->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $formation->getId()]);
           // dd(count($tiersCrea));
            if(count($tiersCrea) != 5){
                
                $this->addFlash(
                    'notice',
                    'formation pas parti'
                );
                return $this->redirectToRoute('app_chevalement');
            }
            $manager->persist($combat);
            $manager->flush();
            $idCombat = $combat->getId();
            $moteurCombatService->combat($formation, $scenario,$idCombat);
            $this->addFlash(
                'notice',
                'formation revenue!'
            );
            return $this->redirectToRoute('app_chevalement');
        } 
        return $this->render('chevalement/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'ChevalementController',           
        ]);
    }
}
