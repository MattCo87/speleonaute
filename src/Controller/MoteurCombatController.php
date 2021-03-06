<?php

namespace App\Controller;
use App\Entity\ActionStrategie;
use App\Entity\Creature;
use App\Entity\CreatureFormation;
use App\Entity\StatistiqueCreature;
use App\Entity\StrategieModele;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class MoteurCombatController extends AbstractController
{
    /**
     * @Route("/moteur/combat/new/{id}", name="app_moteur_combat")
     */
    public function new(Creature $creature, ManagerRegistry $doctrine, int $id): Response
    {
        $id = 2;
        //Tableau Hote
        $tableauHote = array();
        $tiersCrea = $doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $id]);
        foreach($tiersCrea as $crea){
            $idCrea = $crea->getlienCreature();
            array_push($tableauHote, $idCrea->getId());
        }
        //Tableau monstre
        $id = 1;
        $tableauMonstre = array();
        $tiersCrea2 = $doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $id]);
        foreach($tiersCrea2 as $crea){
            $idCrea2 = $crea->getlienCreature();
            array_push($tableauMonstre, $idCrea2->getId());
        }
        //TableauCreature
        $tableauCreature = array();
        foreach($tableauHote as $hote){
            $creature = $doctrine->getRepository(Creature::class)->findBy(['id' => $hote]);
            foreach($creature as $crea){
                $Creature2['id'] = $crea->getId();
                $Creature2['nom'] = $crea->getNom();
                $Creature2['niveau'] = $crea->getNiveau();
                $Creature2['exp'] = $crea->getExp();
                $Creature2['idModele'] = $crea->getlienModele()->getId();
            }
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
                $Creature2['id'] = $crea->getId();
                $Creature2['nom'] = $crea->getNom();
                $Creature2['niveau'] = $crea->getNiveau();
                $Creature2['exp'] = $crea->getExp();
                $Creature2['idModele'] = $crea->getlienModele()->getId();
                }
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
        $tableauAction = array();
        foreach($tableauCreature as $creature){
            $strategie = $doctrine->getRepository(StrategieModele::class)->findBy(['lienModele' => $creature['idModele']]);
            $idStrategie = $strategie[0]->getlienStrategie()->getId();
            $actions = $doctrine->getRepository(ActionStrategie::class)->findBy(['lienStrategie' => $idStrategie]);
            foreach($actions as $action){
                $Action2['idCreature'] = $creature['id'];
                $Action2['positionAction'] = $action->getPositionAction();
                $Action2['nom'] = $action->getLienAction()->getNom();
                $Action2['toucher'] = $action->getLienAction()->getToucher();
                $Action2['degat'] = $action->getLienAction()->getDegat();
                $Action2['tier'] = $action->getLienAction()->getTier();
                array_push($tableauAction, $Action2);
                }
        }
        ///////Ouverture de ficher
        // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // create a new file and add contents
        try {
            $new_file_path = $current_dir_path . "/../var/combatLog/bar.txt";
            if (!$fsObject->exists($new_file_path)){
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
        $alli??Vivant = 0;
        $ennemiVivant = 0;
        while( ($tour < 50) && ($alli??Vivant < 5) && ($ennemiVivant < 5) ){
            $tour++;
            $tourAction++;
            $fsObject->appendToFile($new_file_path, "Tour".$tour."\n");
            $fsObject->appendToFile($new_file_path, "Phase d'initiative"."\n");
            ///////Initiative
            for( $i=0; ($i<count($tableauCreature)) ; $i++){
                if($tableauCreature[$i]['cote'] == 0 && $tableauCreature[$i]['pvActuel']>0){
                    $random = rand(1, 20);
                    $tableauCreature[$i]['initiative'] = $tableauCreature[$i]['vitesse'] + $random;
                    $fsObject->appendToFile($new_file_path, "initiative de ".$tableauCreature[$i]['nom']." est egale ?? sa vitesse ".$tableauCreature[$i]['vitesse']." + un jet d'initiative (".$random.") = =".$tableauCreature[$i]['initiative']."\n");
                }          
            }
            for( $i=0; ($i<count($tableauCreature)) ; $i++){
                if($tableauCreature[$i]['cote'] == 1 && $tableauCreature[$i]['pvActuel']>0){
                    $random = rand(1, 20);
                    $tableauCreature[$i]['initiative'] = $tableauCreature[$i]['vitesse'] + $random;
                    $fsObject->appendToFile($new_file_path, "initiative de ".$tableauCreature[$i]['nom']." est egale ?? sa vitesse ".$tableauCreature[$i]['vitesse']." + un jet d'initiative (".$random.") = =".$tableauCreature[$i]['initiative']."\n");
                }
            }
            //////Tri par initiative
            $initiative = array();
            foreach ($tableauCreature as $key => $row){
                $initiative[$key] = $row['initiative'];
            }
            array_multisort($initiative, SORT_DESC, $tableauCreature);
            ////////Action des differente creature
            foreach($tableauCreature as $creature){
                if($creature['pvActuel'] > 0 && $alli??Vivant < 5 && $ennemiVivant <5 ){
                    if($tourAction == 6){
                        $tourAction = 1;
                    }
                    $indexAction = 0;
                    $fsObject->appendToFile($new_file_path,"tour Action ".$tourAction." \n");
                    foreach($tableauAction as $action){
                        if(($action['idCreature'] == $creature['id']) && ($action['positionAction'] == $tourAction)){
                            break;
                        }else{
                            $indexAction++;
                        }
                    }
                    if($creature['cote'] == 0){
                        do{
                            $taille = count($tableauMonstre)-1;
                            $a = rand(0, $taille);
                            $idCible = $tableauMonstre[$a];
                            $cible = 0;
                            $tableauCreatureCopie = $tableauCreature;
                            foreach($tableauCreatureCopie as $creatureCopie){
                                if($creatureCopie['id'] == $idCible){
                                    break;
                            }else{
                                $cible++;
                            }
                            
                        }
                        if($tableauCreature[$cible]['pvActuel'] > 0){
                            $isOk = 1;
                        }else{
                            $isOk = 0;
                        }
                        }while($isOk == 0);
                    }
                    if($creature['cote'] == 1){
                        do{
                            $taille = count($tableauHote)-1;
                            $a = rand(0, $taille);
                            $idCible = $tableauHote[$a];
                            $cible = 0;
                            $tableauCreatureCopie = $tableauCreature;
                            foreach($tableauCreatureCopie as $creatureCopie){
                                if($creatureCopie['id'] == $idCible){
                                    break;
                                }else{
                                    $cible++;
                                }
                            }
                            if($tableauCreature[$cible]['pvActuel'] > 0){
                                $isOk = 1;
                            }else{
                                $isOk = 0;
                            }
                        }while($isOk == 0);
                    }
                    $d20 = rand(1,20);
                    $toucher = $creature['toucher'] + $tableauAction[$indexAction]['toucher'] + $d20;
                    $fsObject->appendToFile($new_file_path,"".$creature['nom']." realise l'action ".$tableauAction[$indexAction]['nom']."(Tier ".$tableauAction[$indexAction]['tier'].") contre ".$tableauCreature[$cible]['nom']."\n");
                    $fsObject->appendToFile($new_file_path,"attaque de ".$creature['nom']." est egale ?? son toucher ".$creature['toucher']." plus un jet de toucher (".$d20.") auquel on ajoute aussi le bonus de toucher le l'action ".$tableauAction[$indexAction]['toucher']." = ".$toucher."\n");
                    $defense = $tableauCreature[$cible]['toucher'] + $d20;
                    $fsObject->appendToFile($new_file_path,"defense de ".$tableauCreature[$cible]['nom']." est egale ?? son toucher ".$tableauCreature[$cible]['toucher']." plus un jet de toucher (".$d20.") = ".$defense."\n");
                    if($toucher < $defense){
                        $fsObject->appendToFile($new_file_path,"Defense reussite"."\n");
                    }else{
                        $fsObject->appendToFile($new_file_path,"Defense echou??"."\n");
                        $degat = floor($creature['degat']/2) + $tableauAction[$indexAction]['degat'];
                        $fsObject->appendToFile($new_file_path,"degat de ".$creature['nom']." est egale ?? son degat diviser par deux (arrondie a l'inferieur) (".floor($creature['degat']/2).") plus le bonus de degat le l'action ".$tableauAction[$indexAction]['degat']." = ".$degat."\n");
                        $resistance = floor($tableauCreature[$cible]['resistance']/2);
                        $fsObject->appendToFile($new_file_path,"resistance de ".$tableauCreature[$cible]['nom']." est egale ?? sa resistance diviser par deux (arrondie a l'inferieur) (".floor($tableauCreature[$cible]['resistance']/2).") = ".$resistance."\n");
                        if($degat <= $resistance){
                            $fsObject->appendToFile($new_file_path,"".$tableauCreature[$cible]['nom']." ?? resister a l'attaque"."\n");
                        }else{
                            $degatSubit = $degat - $resistance;
                            $fsObject->appendToFile($new_file_path,"".$tableauCreature[$cible]['nom']." ?? subit ".$degatSubit." de degat"."\n");
                            $tableauCreature[$cible]['pvActuel'] = $tableauCreature[$cible]['pvActuel']- $degatSubit;
                            if($tableauCreature[$cible]['pvActuel'] <= 0){
                                $fsObject->appendToFile($new_file_path,"".$tableauCreature[$cible]['nom']." est mort au combat"."\n");
                                if($tableauCreature[$cible]['cote'] == 0){
                                    $alli??Vivant++;
                                }else{
                                    $ennemiVivant++;
                                }
                            }
                            else{
                                $fsObject->appendToFile($new_file_path,"".$tableauCreature[$cible]['nom']." survit avec ".$tableauCreature[$cible]['pvActuel']." pv"."\n");
                            }

                        }


                    }
                }
            }
        }
        ///Fin du combat
        if($alli??Vivant ==5){
            $fsObject->appendToFile($new_file_path,"Defaite "."\n");
        }else{
            $fsObject->appendToFile($new_file_path,"Vctoire "."\n");
            //il faudrait recuperer les recompense associ?? au scenario
            $recompense = 10;
            //il faudrait ajouter les recoppense a la reputation de l'utilisateur
            for($i=0; ($i<count($tableauCreature)) ; $i++){
                if($tableauCreature[$i]['cote'] == 0){
                    $tableauCreature[$i]['exp'] = $tableauCreature[$i]['exp'] + $recompense;
                    // modifier l'exp de l'hote en bdd
                    $fsObject->appendToFile($new_file_path,"".$tableauCreature[$i]['nom']." ?? gagn?? ".$recompense." pex"."\n");
                }
            }
        }dd($tableauCreature);
    }
    /*public function index(): Response
    {
        return $this->render('moteur_combat/index.html.twig', [
            'controller_name' => 'MoteurCombatController',
        ]);
    }*/
}
