<?php

namespace App\Controller;

use App\Entity\Creature;
use App\Entity\CreatureFormation;
use App\Service\Test;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Query\QueryBuilder;

class MoteurCombatController extends AbstractController
{
    /**
     * @Route("/moteur/combat/new/{id}", name="app_moteur_combat")
     */
    public function new(Test $test, CreatureFormation $creatureFormation,Creature $creature, ManagerRegistry $doctrine, int $id): Response
    {
        // thanks to the type-hint, the container will instantiate a
        // new MessageGenerator and pass it to you!
        // ...
       // $id = 1;
        $tableauHote = array();
        //$tiersCrea = $creatureFormation->getRepository(CreatureFormation::class)->findAll();
        //$tiersCrea = array();
        $tiersCrea = $doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $id]);
       // $nom = $tiersCrea->getNom();
       //dd($tiersCrea);
       foreach($tiersCrea as $crea){
           $idCrea = $crea->getlienCreature();
       // $tableauHote = $idCrea->getNom();
        array_push($tableauHote, $idCrea->getId());
       }
       dd($tableauHote);





        $test = $tiersCrea->getlienCreature();
        dd($test->getNom());


        $message = $test->getHappyMessage();
       // dd($message);
        $this->addFlash('success', $message);
        // ...
        return $this->render('moteur_combat/index.html.twig', [
            'controller_name' => 'MCController',
        ]);
    }














     /*
    public function index(): Response
    {
        return $this->render('moteur_combat/index.html.twig', [
            'controller_name' => 'MoteurCombatController',
        ]);
    }*/


}
