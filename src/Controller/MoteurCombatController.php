<?php

namespace App\Controller;

use App\Entity\Action;
use App\Entity\ActionStrategie;
use App\Entity\Creature;
use App\Entity\CreatureFormation;
use App\Entity\Modele;
use App\Entity\StatistiqueCreature;
use App\Entity\StrategieModele;
use App\Service\Test;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
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
        $id = 2;

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
       $id = 1;
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
                //   dd($creature);
                //$idCrea2 = $crea->getNom();
                // dd($idCrea2);
                // $tableauHote = $idCrea->getNom();
                $Creature2['id'] = $crea->getId();
                $Creature2['nom'] = $crea->getNom();
                $Creature2['niveau'] = $crea->getNiveau();
                $Creature2['exp'] = $crea->getExp();
                $Creature2['idModele'] = $crea->getlienModele()->getId();
                }
                //dd($Creature2);
                $statCreature = $doctrine->getRepository(StatistiqueCreature::class)->findBy(['lienCreature' => $Creature2['id']]);
                $Creature2['toucher']= $statCreature[0]->getValeur();
                $Creature2['degat']= $statCreature[1]->getValeur();
                $Creature2['resistance']= $statCreature[2]->getValeur();
                $Creature2['vitesse']= $statCreature[3]->getValeur();
                $Creature2['endurance']= $statCreature[4]->getValeur();
                $Creature2['pvMax']=$Creature2['endurance']+$Creature2['niveau']*2+20;
                $Creature2['pvActuel']=$Creature2['pvMax'];
                $Creature2['cote']=0;
                $Creature2['initiative']=0;
            array_push($tableauCreature, $Creature2);
        }       
        foreach($tableauMonstre as $monstre){
        
            $creature = $doctrine->getRepository(Creature::class)->findBy(['id' => $monstre]);
            foreach($creature as $crea){
                //   dd($creature);
                   // $idCrea2 = $crea->getNom();
                // dd($idCrea2);
                // $tableauHote = $idCrea->getNom();
                $Creature2['id'] = $crea->getId();
                $Creature2['nom'] = $crea->getNom();
                $Creature2['niveau'] = $crea->getNiveau();
                $Creature2['exp'] = $crea->getExp();
                $Creature2['idModele'] = $crea->getlienModele()->getId();
                }
                //dd($Creature2);
                $statCreature = $doctrine->getRepository(StatistiqueCreature::class)->findBy(['lienCreature' => $Creature2['id']]);
                $Creature2['toucher']= $statCreature[0]->getValeur();
                $Creature2['degat']= $statCreature[1]->getValeur();
                $Creature2['resistance']= $statCreature[2]->getValeur();
                $Creature2['vitesse']= $statCreature[3]->getValeur();
                $Creature2['endurance']= $statCreature[4]->getValeur();
                $Creature2['pvMax']=$Creature2['endurance']+$Creature2['niveau']*2+20;
                $Creature2['pvActuel']=$Creature2['pvMax'];
                $Creature2['cote']=1;
                $Creature2['initiative']=0;
            array_push($tableauCreature, $Creature2);
    
        }
        //dd($tableauCreature,$tableauHote,$tableauMonstre);
        $tableauAction = array();
        foreach($tableauCreature as $creature){
            $strategie = $doctrine->getRepository(StrategieModele::class)->findBy(['lienModele' => $creature['idModele']]);
            $idStrategie = $strategie[0]->getlienStrategie()->getId();
            $actions = $doctrine->getRepository(ActionStrategie::class)->findBy(['lienStrategie' => $idStrategie]);
           // dd($creature);
            
            foreach($actions as $action){
                $Action2['idCreature'] = $creature['id'];
                $Action2['positionAction'] = $action->getPositionAction();
                $Action2['nom'] = $action->getLienAction()->getNom();
                $Action2['toucher'] = $action->getLienAction()->getToucher();
                $Action2['degat'] = $action->getLienAction()->getDegat();
                $Action2['tier'] = $action->getLienAction()->getTier();
               // dd($Action2);

               // $attaque = $doctrine->getRepository(Action::class)->findBy(['lienAction' => $action->getlienAction()]);
                //dd($attaque);
                array_push($tableauAction, $Action2);
            }
            

    }
    dd($tableauAction);
    ///////Ouverture de ficher
        // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd(); 
    // create a new file and add contents
    try {
        $new_file_path = $current_dir_path . "/../var/combatLog/bar.txt";
        //dd($new_file_path);
        if (!$fsObject->exists($new_file_path))
        {
            $fsObject->touch($new_file_path);
            $fsObject->chmod($new_file_path, 0777);
            $fsObject->dumpFile($new_file_path, "Adding dummy content to bar.txt file.\n");
            $fsObject->appendToFile($new_file_path, "This should be added to the end of the file.\n");
        }
    } catch (IOExceptionInterface $exception) {
        echo "Error creating file at". $exception->getPath();
    }


    //////Moteur C PARTI
    $tour = 0;
    $tourAction = 0;
    $alliéVivant = 1;
    $ennemiVivant = 1;

    while( $tour < 50 || $alliéVivant == 0 || $ennemiVivant ==0 ){

        $tour++;
        $tourAction++;
        $fsObject->appendToFile($new_file_path, "Tour".$tour."\n");
        $fsObject->appendToFile($new_file_path, "Phase d'initiative"."\n");

    ///////Initiative
    //dd(count($tableauCreature));
    for( $i=0; ($i<count($tableauCreature)) ; $i++){
        //dd($i);
        if($tableauCreature[$i]['cote'] == 0){
            $random = rand(1, 20);
            $tableauCreature[$i]['initiative'] = $tableauCreature[$i]['vitesse'] + $random;
            $fsObject->appendToFile($new_file_path, "initiative de ".$tableauCreature[$i]['nom']." est egale à sa vitesse ".$tableauCreature[$i]['vitesse']." + un jet d'initiative (".$random.") = =".$tableauCreature[$i]['initiative']."\n");
        }


        
    }
    for( $i=0; ($i<count($tableauCreature)) ; $i++){
        //dd($i);
        if($tableauCreature[$i]['cote'] == 1){
            $random = rand(1, 20);
            $tableauCreature[$i]['initiative'] = $tableauCreature[$i]['vitesse'] + $random;
            $fsObject->appendToFile($new_file_path, "initiative de ".$tableauCreature[$i]['nom']." est egale à sa vitesse ".$tableauCreature[$i]['vitesse']." + un jet d'initiative (".$random.") = =".$tableauCreature[$i]['initiative']."\n");
        }


        
    }
    //dd($tableauCreature);


    //////Tri par initiative
    $initiative = array();
	foreach ($tableauCreature as $key => $row)
	{
		$initiative[$key] = $row['initiative'];
		
	}
	array_multisort($initiative, SORT_DESC, $tableauCreature);


    //dd($tableauCreature);   
    ////////Action des differente creature

    foreach($tableauCreature as $creature){

        if($creature['pvActuel'] > 0){

            if($tourAction == 6){
                $tourAction = 1;
            }
            $indexAction = 0;
            foreach($tableauAction as $action){
                if(($action['idCreature'] == $creature['id']) && ($action['positionAction'] == $tourAction)){
                    break;
                }
                $indexAction;
            }
            if($creature['cote'] == 0){
                $idCible = array_rand($tableauMonstre,1);
                $cible = 0;
                $tableauCreatureCopie = $tableauCreature;
                foreach($tableauCreatureCopie as $creatureCopie){
                    if($creatureCopie['id'] == $idCible){
                        break;
                    }
                    $idCible++;
                }
                //dd($cible);
            }
            if($creature['cote'] == 1){
                $cible = array_rand($tableauHote,1);
                $cible = 0;
                $tableauCreatureCopie = $tableauCreature;
                foreach($tableauCreatureCopie as $creatureCopie){
                    if($creatureCopie['id'] == $idCible){
                        break;
                    }
                    $idCible++;
                }
            }
            $d20 = rand(1,20);
            $toucher = $creature['toucher'] + $action['toucher'] + $d20;
            $fsObject->appendToFile($new_file_path,"".$creature['nom']." realise l'action ".$action['nom']."(Tier ".$action['tier'].") contre ".$tableauCreature[$cible]['nom']."\n");
            $fsObject->appendToFile($new_file_path,"attaque de ".$creature['nom']." est egale à son toucher ".$creature['toucher']." plus un jet de toucher (".$d20.") auquel on ajoute aussi le bonus de toucher le l'action ".$action['toucher']." = ".$toucher."\n");









        }



    }




    }



































    dd($tableauCreature);
    
    
    
    
    
    
    
    
    dd($tableauCreature,$tableauHote,$tableauMonstre,$tableauAction);











/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     /*
    public function index(): Response
    {
        return $this->render('moteur_combat/index.html.twig', [
            'controller_name' => 'MoteurCombatController',
        ]);
    }*/


}
}
