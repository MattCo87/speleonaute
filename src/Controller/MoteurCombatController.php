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
use PhpParser\Node\Stmt\Foreach_;

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

       //Tableau Hote
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
      // dd($tableauHote);


      //Tableau monstre
       $id = 2;
       $tableauMonstre = array();
       //$tiersCrea = $creatureFormation->getRepository(CreatureFormation::class)->findAll();
       //$tiersCrea = array();
       $tiersCrea2 = $doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $id]);
      // $nom = $tiersCrea->getNom();
      //dd($tiersCrea);
      foreach($tiersCrea2 as $crea){
          $idCrea2 = $crea->getlienCreature();
      // $tableauHote = $idCrea->getNom();
       array_push($tableauMonstre, $idCrea2->getId());
      }
      //dd($tableauMonstre);

    


      //TableauCreature
         $tableauCreature = array();
        foreach($tableauHote as $hote){
        
        $creature = $doctrine->getRepository(Creature::class)->findBy(['id' => $hote]);
            foreach($creature as $crea){
                $idCrea2 = $crea->getNom();
               // dd($idCrea2);
            // $tableauHote = $idCrea->getNom();
            $Creature2['nom'] = $crea->getNom();
            $Creature2['niveau'] = $crea->getNiveau();
            $Creature2['exp'] = $crea->getExp();
            dd($Creature2);
            }
        dd($creature);
       // $tableauCreature[0]['nom' => $creature->getNom()];
        $nom = $creature->getNom();





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

    }



     /*
    public function index(): Response
    {
        return $this->render('moteur_combat/index.html.twig', [
            'controller_name' => 'MoteurCombatController',
        ]);
    }*/


}
