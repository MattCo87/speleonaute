<?php
// src/Service/Test.php
namespace App\Service;

use App\Entity\ActionStrategie;
use App\Entity\Combat;
use App\Entity\Creature;
use App\Entity\CreatureFormation;
use App\Entity\Formation;
use App\Entity\Scenario;
use App\Entity\StatistiqueCreature;
use App\Entity\StrategieModele;
use App\Repository\ModeleRepository;
use App\Repository\StatistiqueModeleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class MoteurCombatService2 extends ServiceEntityRepository
{
    private $doctrine;

    function __construct(ManagerRegistry $doctrine, EntityManagerInterface $manager, ModeleRepository $emm, StatistiqueModeleRepository $emsm)
    {
        $this->doctrine = $doctrine;
        $this->manager = $manager;
        $this->emm = $emm;
        $this->emsm = $emsm;
    }


    public function NiveauPlus( Creature $creature)
    {
        $idModele = $creature->getLienModele();
        $pointNiv = $creature->getLienModele()->getPointNiv();
        // On récupére le modèle
        $tab_stat = $this->emsm->findBy(['lienModele' => $idModele]);
        // On fabrique un tableau avec le Numéro de la statistique et sa valeur de niveau
        $i = 0;
        $total_points = 0;
        foreach ($tab_stat as $stat) {
            $tabStat[$i][0] = $stat->getLienStatistique();
            $tabStat[$i][1] = $stat->getValeurNiv();
            $total_points = $total_points + $tabStat[$i][1];
            $i++;
        }
        // Pour chaque statistique
        $i = 0;
        foreach ($tabStat as $stat) {
            // On récupére la valeur de niveau
            $stop = $tabStat[$i][1];
            // On ajoute 'stop fois' la statistique au tableau de tirage au sort 
            for ($j = 0; $j < $stop; $j++) {
                $tab_tas[] = $tabStat[$i][0];
            }
            $i++;
        }
        // On mélange le tableau
        shuffle($tab_tas);
        // On choisit la stat et on ajoute 1 point
        for ($z = 0; $z < $pointNiv; $z++) {
            $alea = rand(0, $total_points-1);
            $tab_final[] = $tab_tas[$alea];
        }
        $stat = $this->doctrine->getRepository(StatistiqueCreature::class)->findBy(['lienCreature' => $idModele->getId()]);
        for( $z = 0; $z < count($tab_final); $z++){
            switch ($tab_final[$z]->getId()){
                case $stat[0]->getLienStatistique()->getId():
                    $statFinal = $stat[0]->getValeur()+1;
                    $stat[0]->setValeur($statFinal);
                    $this->manager->persist($stat[0]);
                break;

                case $stat[1]->getLienStatistique()->getId():
                    $statFinal = $stat[1]->getValeur()+1;
                    $stat[1]->setValeur($statFinal);
                    $this->manager->persist($stat[1]);
                break;

                case $stat[2]->getLienStatistique()->getId():
                    $statFinal = $stat[2]->getValeur()+1;
                    $stat[2]->setValeur($statFinal);
                    $this->manager->persist($stat[2]);
                break;

                case $stat[3]->getLienStatistique()->getId():
                    $statFinal = $stat[3]->getValeur()+1;
                    $stat[3]->setValeur($statFinal);
                    $this->manager->persist($stat[3]);
                break;

                case $stat[4]->getLienStatistique()->getId():
                    $statFinal = $stat[4]->getValeur()+1;
                    $stat[4]->setValeur($statFinal);
                    $this->manager->persist($stat[4]);
                break;
            }
        }
    }


    public function combat(Formation $formation, Scenario $scenario, int $idCombat)
    {
        
        $nomCombat = "" . $formation->getLienUser()->getEmail() . "_Combat_" . $idCombat . "";
        $id = $formation->getId();
        //Tableau Hote
        $tableauHote = array();
        $tableauHote1 = array();
        $tableauHote2 = array();
        $tableauHote3 = array();
        $tableauHotePex = array();
        $tiersCrea = $this->doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $id]);
        //dd($tiersCrea);
        foreach ($tiersCrea as $crea) {
            switch($crea->getLocalisation()){
                case 1:
                    $idCrea = $crea->getLienCreature();
                    array_push($tableauHotePex, $idCrea);
                    array_push($tableauHote1, $idCrea->getId());
                    array_push($tableauHote, $idCrea->getId());
                break;
                case 2:
                    $idCrea = $crea->getLienCreature();
                    array_push($tableauHotePex, $idCrea);
                    array_push($tableauHote2, $idCrea->getId());
                    array_push($tableauHote, $idCrea->getId());
                break;
                case 3:
                    $idCrea = $crea->getLienCreature();
                    array_push($tableauHotePex, $idCrea);
                    array_push($tableauHote3, $idCrea->getId());
                    array_push($tableauHote, $idCrea->getId());
                break;
            }
        }
        //Tableau monstre
        $idScenario = $scenario->getLienFormation()->getId();
        $tableauMonstre = array();
        $tableauMonstre1 = array();
        $tableauMonstre2 = array();
        $tableauMonstre3 = array();
        $tiersCrea2 = $this->doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $idScenario]);
        foreach ($tiersCrea2 as $crea) {
            switch($crea->getLocalisation()){
                case 1:
                    $idCrea2 = $crea->getLienCreature();
                    array_push($tableauMonstre1, $idCrea2->getId());
                    array_push($tableauMonstre, $idCrea2->getId());
                break;
                case 2:
                    $idCrea2 = $crea->getLienCreature();
                    array_push($tableauMonstre2, $idCrea2->getId());
                    array_push($tableauMonstre, $idCrea2->getId());
                break;
                case 3:
                    $idCrea2 = $crea->getLienCreature();
                    array_push($tableauMonstre3, $idCrea2->getId());
                    array_push($tableauMonstre, $idCrea2->getId());
                break;
            }
        }
        //TableauCreature
        $tableauCreature = array();
        foreach ($tableauHote as $hote) {
            $creature = $this->doctrine->getRepository(Creature::class)->findBy(['id' => $hote]);
            foreach ($creature as $crea) {
                $Creature2['id'] = $crea->getId();
                $Creature2['nom'] = $crea->getNom();
                $Creature2['niveau'] = $crea->getNiveau();
                $Creature2['exp'] = $crea->getExp();
                $Creature2['idModele'] = $crea->getLienModele()->getId();
            }
            $statCreature = $this->doctrine->getRepository(StatistiqueCreature::class)->findBy(['lienCreature' => $Creature2['id']]);
            $Creature2['toucher'] = $statCreature[0]->getValeur();
            $Creature2['degat'] = $statCreature[1]->getValeur();
            $Creature2['resistance'] = $statCreature[2]->getValeur();
            $Creature2['vitesse'] = $statCreature[3]->getValeur();
            $Creature2['endurance'] = $statCreature[4]->getValeur();
            $Creature2['pvMax'] = $Creature2['endurance'] + $Creature2['niveau'] * 2 + 20;
            $Creature2['pvActuel'] = $Creature2['pvMax'];
            $Creature2['cote'] = 0;
            $Creature2['initiative'] = 0;
            $localisationsCrea = $this->doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $id]);
            foreach ($localisationsCrea as $localisationCrea) {
                if($localisationCrea->getLienCreature()->getId() == $hote){
                    $Creature2['localisation'] = $localisationCrea->getLocalisation();
                }
            }
            array_push($tableauCreature, $Creature2);
        }
        foreach ($tableauMonstre as $monstre) {
            $creature = $this->doctrine->getRepository(Creature::class)->findBy(['id' => $monstre]);
            foreach ($creature as $crea) {
                $Creature2['id'] = $crea->getId();
                $Creature2['nom'] = $crea->getNom();
                $Creature2['niveau'] = $crea->getNiveau();
                $Creature2['exp'] = $crea->getExp();
                $Creature2['idModele'] = $crea->getLienModele()->getId();
            }
            $statCreature = $this->doctrine->getRepository(StatistiqueCreature::class)->findBy(['lienCreature' => $Creature2['id']]);
            $Creature2['toucher'] = $statCreature[0]->getValeur();
            $Creature2['degat'] = $statCreature[1]->getValeur();
            $Creature2['resistance'] = $statCreature[2]->getValeur();
            $Creature2['vitesse'] = $statCreature[3]->getValeur();
            $Creature2['endurance'] = $statCreature[4]->getValeur();
            $Creature2['pvMax'] = $Creature2['endurance'] + $Creature2['niveau'] * 2 + 20;
            $Creature2['pvActuel'] = $Creature2['pvMax'];
            $Creature2['cote'] = 1;
            $Creature2['initiative'] = 0;
            $localisationsCrea = $this->doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $idScenario]);
            foreach ($localisationsCrea as $localisationCrea) {
                if($localisationCrea->getLienCreature()->getId() == $monstre){
                    $Creature2['localisation'] = $localisationCrea->getLocalisation();
                }
            }
            array_push($tableauCreature, $Creature2);
        }
        /////Tableau Action
        $tableauAction = array();
        foreach ($tableauCreature as $creature) {
            $strategie = $this->doctrine->getRepository(StrategieModele::class)->findBy(['lienModele' => $creature['idModele']]);
            $idStrategie = $strategie[0]->getlienStrategie()->getId();
            $actions = $this->doctrine->getRepository(ActionStrategie::class)->findBy(['lienStrategie' => $idStrategie]);
            foreach ($actions as $action) {
                $Action2['idCreature'] = $creature['id'];
                $Action2['positionAction'] = $action->getPositionAction();
                $Action2['nom'] = $action->getLienAction()->getNom();
                $Action2['toucher'] = $action->getLienAction()->getToucher();
                $Action2['degat'] = $action->getLienAction()->getDegat();
                $Action2['tier'] = $action->getLienAction()->getTier();
                //ajout moteurV2
                $Action2['localisation'] = $action->getLienAction()->getLocalisation();
                $Action2['nombreCible'] = $action->getLienAction()->getNombreCible();
                array_push($tableauAction, $Action2);
            }
            
        }
        ///////Ouverture de ficher
        // init file system
        $fsObject = new Filesystem();
        $current_dir_path = getcwd();
        // create a new file and add contents
        try {
            $new_file_path = $current_dir_path . "/../var/combatLog/" . $nomCombat . ".txt";
            if (!$fsObject->exists($new_file_path)) {
                $fsObject->touch($new_file_path);
                $fsObject->chmod($new_file_path, 0777);
                $fsObject->dumpFile($new_file_path, "###########################################################\n");
                $fsObject->appendToFile($new_file_path, "############           Log De Combat           ############\n");
                $fsObject->appendToFile($new_file_path, "###########################################################\n\n\n\n\n\n");
            }
        } catch (IOExceptionInterface $exception) {
            echo "Error creating file at" . $exception->getPath();
        }


        $fsObject->appendToFile($new_file_path, "                         __________\n");
        $fsObject->appendToFile($new_file_path, "                      .~#########%%;~.\n");
        $fsObject->appendToFile($new_file_path, "                     /############%%;`\'" . "\n");
        $fsObject->appendToFile($new_file_path, "                    /######/~\/~\%%;,;,\'" . "\n");
        $fsObject->appendToFile($new_file_path, "                   |#######\    /;;;;.,.|\n");
        $fsObject->appendToFile($new_file_path, "                   |#########\/%;;;;;.,.|\n");
        $fsObject->appendToFile($new_file_path, "          XX       |##/~~\####%;;;/~~\;,|       XX\n");
        $fsObject->appendToFile($new_file_path, "        XX..X      |#|  o  \##%;/  o  |.|      X..XX\n");
        $fsObject->appendToFile($new_file_path, "      XX.....X     |##\____/##%;\____/.,|     X.....XX\n");
        $fsObject->appendToFile($new_file_path, " XXXXX.....XX      \#########/\;;;;;;,, /      XX.....XXXXX\n");
        $fsObject->appendToFile($new_file_path, "X |......XX%,.@      \######/%;\;;;;, /      @#%,XX......| X\n");
        $fsObject->appendToFile($new_file_path, "X |.....X  @#%,.@     |######%%;;;;,.|     @#%,.@  X.....| X\n");
        $fsObject->appendToFile($new_file_path, "X  \...X     @#%,.@   |# # # % ; ; ;,|   @#%,.@     X.../  X\n");
        $fsObject->appendToFile($new_file_path, " X# \.X        @#%,.@                  @#%,.@        X./  #\n");
        $fsObject->appendToFile($new_file_path, "  ##  X          @#%,.@              @#%,.@          X   #\n");
        $fsObject->appendToFile($new_file_path, ", '# #X            @#%,.@          @#%,.@            X ##\n");
        $fsObject->appendToFile($new_file_path, "   `###X             @#%,.@      @#%,.@             ####'\n");
        $fsObject->appendToFile($new_file_path, "  . ' ###              @#%.,@  @#%,.@              ###`'\n");
        $fsObject->appendToFile($new_file_path, "    . ';'                @#%.@#%,.@                ;'` ' .\n");
        $fsObject->appendToFile($new_file_path, "      '                    @#%,.@                   ,.\n");
        $fsObject->appendToFile($new_file_path, "      ` ,                @#%,.@  @@                `\n");
        $fsObject->appendToFile($new_file_path, "                          @@@  @@@  \n");



        //////Moteur C PARTI
        $tour = 0;
        $tourAction = 0;
        $alliéVivant = 0;
        $ennemiVivant = 0;
        while ( $tour < 50 && ($tableauHote && $tableauMonstre) ){
            $tour++;
            $tourAction++;
            $fsObject->appendToFile($new_file_path, "\n\n\n");
            $fsObject->appendToFile($new_file_path, "###################################################\n");
            $fsObject->appendToFile($new_file_path, "############           Tour " . $tour . "           ############\n");
            $fsObject->appendToFile($new_file_path, "###################################################\n\n\n\n\n\n");
            $fsObject->appendToFile($new_file_path, "Phase d'initiative" . "\n\n");
            ///////Initiative
            for ($i = 0; ($i < count($tableauCreature)); $i++) {
                if ($tableauCreature[$i]['cote'] == 0 && $tableauCreature[$i]['pvActuel'] > 0) {
                    $random = rand(1, 20);
                    $tableauCreature[$i]['initiative'] = $tableauCreature[$i]['vitesse'] + $random;
                    $fsObject->appendToFile($new_file_path, "initiative de " . $tableauCreature[$i]['nom'] . " est egale à sa vitesse " . $tableauCreature[$i]['vitesse'] . " + un jet d'initiative (" . $random . ") =" . $tableauCreature[$i]['initiative'] . "\n");
                }
            }
            $fsObject->appendToFile($new_file_path, "\n");
            for ($i = 0; ($i < count($tableauCreature)); $i++) {
                if ($tableauCreature[$i]['cote'] == 1 && $tableauCreature[$i]['pvActuel'] > 0) {
                    $random = rand(1, 20);
                    $tableauCreature[$i]['initiative'] = $tableauCreature[$i]['vitesse'] + $random;
                    $fsObject->appendToFile($new_file_path, "initiative de " . $tableauCreature[$i]['nom'] . " est egale à sa vitesse " . $tableauCreature[$i]['vitesse'] . " + un jet d'initiative (" . $random . ") =" . $tableauCreature[$i]['initiative'] . "\n");
                }
            }
            $fsObject->appendToFile($new_file_path, "\n");
            $fsObject->appendToFile($new_file_path, "###################################################\n\n");
            //////Tri par initiative
            $initiative = array();
            foreach ($tableauCreature as $key => $row) {
                $initiative[$key] = $row['initiative'];
            }
            array_multisort($initiative, SORT_DESC, $tableauCreature);
            ////////Action des differente creature
            foreach ($tableauCreature as $creature) {
                if ($creature['pvActuel'] > 0 && $tableauHote && $tableauMonstre ) {
                    var_dump($creature);
                    if ($tourAction == 6) {
                        $tourAction = 1;
                    }
                    $indexAction = 0;
                    foreach ($tableauAction as $action) {
                        if (($action['idCreature'] == $creature['id']) && ($action['positionAction'] == $tourAction)) {
                            break;
                        } else {
                            $indexAction++;
                        }
                    }

                    $fsObject->appendToFile($new_file_path, "Action " . $tableauAction[$indexAction]['nom'] . "(Tier " . $tableauAction[$indexAction]['tier'] . ") - localisation ".$tableauAction[$indexAction]['localisation']." ciblera ".$tableauAction[$indexAction]['nombreCible']." creature\n");
                    $tableauMonstre1Copie = $tableauMonstre1;
                    $tableauMonstre2Copie = $tableauMonstre2;
                    $tableauMonstre3Copie = $tableauMonstre3;
                    $tableauHote1Copie = $tableauHote1;
                    $tableauHote2Copie = $tableauHote2;
                    $tableauHote3Copie = $tableauHote3;
                    $nbCible = $tableauAction[$indexAction]['nombreCible'];
                    //var_dump($tableauHote1Copie,$tableauHote2Copie,$tableauHote3Copie,$tableauMonstre1Copie,$tableauMonstre2Copie,$tableauMonstre3Copie);
                    do{
                       // $cible = 0;
                        //cherche target de l'action

                        if ($creature['cote'] == 0) {
                            //target devant
                            if($tableauAction[$indexAction]['localisation'] == 1 && $tableauMonstre1Copie){
                                $taille = count($tableauMonstre1Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauMonstre1Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauMonstre1Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 1 && empty($tableauMonstre1Copie) && $tableauMonstre2Copie){
                                $taille = count($tableauMonstre2Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauMonstre2Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauMonstre2Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 1 && empty($tableauMonstre1Copie) && empty($tableauMonstre2Copie) && $tableauMonstre3Copie){
                                $taille = count($tableauMonstre3Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauMonstre3Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauMonstre3Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 1 && empty($tableauMonstre1Copie) && empty($tableauMonstre2Copie) && empty($tableauMonstre3Copie)){
                                $nbCible = 0;
                            }

                            //target millieu
                            else if($tableauAction[$indexAction]['localisation'] == 2 && $tableauMonstre2Copie){
                                $taille = count($tableauMonstre2Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauMonstre2Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauMonstre2Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 2 && empty($tableauMonstre2Copie) && $tableauMonstre3Copie){
                                $taille = count($tableauMonstre3Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauMonstre3Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauMonstre3Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 2 && empty($tableauMonstre2Copie) && empty($tableauMonstre3Copie) && $tableauMonstre1Copie){
                                $taille = count($tableauMonstre1Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauMonstre1Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauMonstre1Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 2 && empty($tableauMonstre2Copie) && empty($tableauMonstre3Copie) && empty($tableauMonstre1Copie)){
                                $nbCible = 0;
                            }

                            //target derriere
                            else if($tableauAction[$indexAction]['localisation'] == 3 && $tableauMonstre3Copie){
                                $taille = count($tableauMonstre3Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauMonstre3Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauMonstre3Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 3 && empty($tableauMonstre3Copie) && $tableauMonstre1Copie){
                                $taille = count($tableauMonstre1Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauMonstre1Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauMonstre1Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 3 && empty($tableauMonstre3Copie) && empty($tableauMonstre1Copie) && $tableauMonstre2Copie){
                                $taille = count($tableauMonstre2Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauMonstre2Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauMonstre2Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 3 && empty($tableauMonstre3Copie) && empty($tableauMonstre1Copie) && empty($tableauMonstre2Copie)){
                                $nbCible = 0;
                            }
                        }
                        //var_dump($tableauHote1Copie,$tableauHote2Copie,$tableauHote3Copie,$tableauMonstre1Copie,$tableauMonstre2Copie,$tableauMonstre3Copie,$tableauHote,$tableauMonstre);
                        //cherche target de l'caction pour l'autre equipe
                        if ($creature['cote'] == 1){
                            //target devant
                            if($tableauAction[$indexAction]['localisation'] == 1 && $tableauHote1Copie){
                                $taille = count($tableauHote1Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauHote1Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauHote1Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 1 && empty($tableauHote1Copie) && $tableauHote2Copie){
                                $taille = count($tableauHote2Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauHote2Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauHote2Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 1 && empty($tableauHote1Copie) && empty($tableauHote2Copie) && $tableauHote3Copie){
                                $taille = count($tableauHote3Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauHote3Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauHote3Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 1 && empty($tableauHote1Copie) && empty($tableauHote2Copie) && empty($tableauHote3Copie)){
                                $nbCible = 0;
                            }

                            //target millieu
                            else if($tableauAction[$indexAction]['localisation'] == 2 && $tableauHote2Copie){
                                $taille = count($tableauHote2Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauHote2Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauHote2Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 2 && empty($tableauHote2Copie) && $tableauHote3Copie){
                                $taille = count($tableauHote3Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauHote3Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauHote3Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 2 && empty($tableauHote2Copie) && empty($tableauHote3Copie) && $tableauHote1Copie){
                                $taille = count($tableauHote1Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauHote1Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauHote1Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 2 && empty($tableauHote2Copie) && empty($tableauHote3Copie) && empty($tableauHote1Copie)){
                                $nbCible = 0;
                            }

                            //target derriere
                            else if($tableauAction[$indexAction]['localisation'] == 3 && $tableauHote3Copie){
                                $taille = count($tableauHote3Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauHote3Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauHote3Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 3 && empty($tableauHote3Copie) && $tableauHote1Copie){
                                $taille = count($tableauHote1Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauHote1Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauHote1Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 3 && empty($tableauHote3Copie) && empty($tableauHote1Copie) && $tableauHote2Copie){
                                $taille = count($tableauHote2Copie) - 1;
                                $a = rand(0, $taille);
                                $idCible = $tableauHote2Copie[$a];
                                $cible = 0;
                                $tableauCreatureCopie = $tableauCreature;
                                array_splice($tableauHote2Copie, $a, 1);
                                foreach ($tableauCreatureCopie as $creatureCopie) {
                                    if ($creatureCopie['id'] == $idCible) {
                                        break;
                                    } else {
                                        $cible++;
                                    }
                                }
                            }
                            else if($tableauAction[$indexAction]['localisation'] == 3 && empty($tableauHote3Copie) && empty($tableauHote1Copie) && empty($tableauHote2Copie)){
                                $nbCible = 0;
                            }
                        }
                        //realise l'action
                        $d20 = rand(1, 20);
                        $toucher = $creature['toucher'] + $tableauAction[$indexAction]['toucher'] + $d20;
                        $fsObject->appendToFile($new_file_path, "####" . $creature['nom'] . " realise l'action " . $tableauAction[$indexAction]['nom'] . "(Tier " . $tableauAction[$indexAction]['tier'] . ") contre " . $tableauCreature[$cible]['nom'] . "\n");
                        $fsObject->appendToFile($new_file_path, "attaque de " . $creature['nom'] . " est egale à son toucher " . $creature['toucher'] . " plus un jet de toucher (" . $d20 . ") auquel on ajoute aussi le bonus de toucher le l'action " . $tableauAction[$indexAction]['toucher'] . " = " . $toucher . "\n");
                        $fsObject->appendToFile($new_file_path, "\n");
                        $defense = $tableauCreature[$cible]['toucher'] + $d20;
                        $fsObject->appendToFile($new_file_path, "defense de " . $tableauCreature[$cible]['nom'] . " est egale à son toucher " . $tableauCreature[$cible]['toucher'] . " plus un jet de toucher (" . $d20 . ") = " . $defense . "\n");
                        if ($toucher < $defense) {
                            $fsObject->appendToFile($new_file_path, "Defense reussite" . "\n");
                            $fsObject->appendToFile($new_file_path, "\n");
                        } else {
                            $fsObject->appendToFile($new_file_path, "Defense echoué" . "\n\n");
                            $degat = floor($creature['degat'] / 2) + $tableauAction[$indexAction]['degat'];
                            $fsObject->appendToFile($new_file_path, "degat de " . $creature['nom'] . " est egale à son degat diviser par deux (arrondie a l'inferieur) (" . floor($creature['degat'] / 2) . ") plus le bonus de degat le l'action " . $tableauAction[$indexAction]['degat'] . " = " . $degat . "\n");
                            $fsObject->appendToFile($new_file_path, "\n");
                            $resistance = floor($tableauCreature[$cible]['resistance'] / 2);
                            $fsObject->appendToFile($new_file_path, "resistance de " . $tableauCreature[$cible]['nom'] . " est egale à sa resistance diviser par deux (arrondie a l'inferieur) (" . floor($tableauCreature[$cible]['resistance'] / 2) . ") = " . $resistance . "\n");
                            if ($degat <= $resistance) {
                                $fsObject->appendToFile($new_file_path, "" . $tableauCreature[$cible]['nom'] . " à resister a l'attaque" . "\n");
                                $fsObject->appendToFile($new_file_path, "\n\n");
                            } else {
                                $degatSubit = $degat - $resistance;
                                if($degatSubit < 0){
                                    $degatSubit = 0;
                                }
                                $fsObject->appendToFile($new_file_path, "" . $tableauCreature[$cible]['nom'] . " à subit " . $degatSubit . " de degat" . "\n");
                                $fsObject->appendToFile($new_file_path, "\n");
                                $tableauCreature[$cible]['pvActuel'] = $tableauCreature[$cible]['pvActuel'] - $degatSubit;
                                if ($tableauCreature[$cible]['pvActuel'] <= 0) {
                                    var_dump($tableauCreature[$cible]);
                                    $fsObject->appendToFile($new_file_path, "" . $tableauCreature[$cible]['nom'] . " est mort au combat" . "\n");
                                    $fsObject->appendToFile($new_file_path, "\n");
                                    if ($tableauCreature[$cible]['cote'] == 0) {
                                        $alliéVivant++;
                                        //vide le tableauhote correspond pour pas cibler quelqu'un de mort
                                        switch($tableauCreature[$cible]['localisation']){
                                            case 1:
                                                for($i = 0; $i < count($tableauHote1); $i++){
                                                    if($tableauCreature[$cible]['id'] == $tableauHote1[$i]){
                                                        array_splice($tableauHote1, $i, 1);
                                                    }
                                                }
                                            break;
                                            case 2:
                                                for($i = 0; $i < count($tableauHote2); $i++){
                                                    if($tableauCreature[$cible]['id'] == $tableauHote2[$i]){
                                                        array_splice($tableauHote2, $i, 1);
                                                    }
                                                }
                                            break;
                                            case 3:
                                                for($i = 0; $i < count($tableauHote3); $i++){
                                                    if($tableauCreature[$cible]['id'] == $tableauHote3[$i]){
                                                        array_splice($tableauHote3, $i, 1);
                                                    }
                                                }
                                            break;
                                        }
                                        for($i = 0; $i < count($tableauHote); $i++){
                                            if($tableauCreature[$cible]['id'] == $tableauHote[$i]){    
                                                array_splice($tableauHote, $i, 1);
                                            }
                                        }    
                                    } else {
                                        $ennemiVivant++;
                                        switch($tableauCreature[$cible]['localisation']){
                                            case 1:
                                                for($i = 0; $i < count($tableauMonstre1); $i++){
                                                    if($tableauCreature[$cible]['id'] == $tableauMonstre1[$i]){
                                                        array_splice($tableauMonstre1, $i, 1);
                                                    }
                                                }
                                            break;
                                            case 2:
                                                for($i = 0; $i < count($tableauMonstre2); $i++){
                                                    if($tableauCreature[$cible]['id'] == $tableauMonstre2[$i]){
                                                        array_splice($tableauMonstre2, $i, 1);
                                                    }
                                                }
                                            break;
                                            case 3:
                                                for($i = 0; $i < count($tableauMonstre3); $i++){
                                                    if($tableauCreature[$cible]['id'] == $tableauMonstre3[$i]){
                                                        array_splice($tableauMonstre3, $i, 1);
                                                    }
                                                }
                                            break;
                                        }
                                        for($i = 0; $i < count($tableauMonstre); $i++){
                                            if($tableauCreature[$cible]['id'] == $tableauMonstre[$i]){
                                                array_splice($tableauMonstre, $i, 1);
                                            }
                                        }
                                    }
                                } else {
                                    $fsObject->appendToFile($new_file_path, "" . $tableauCreature[$cible]['nom'] . " survit avec " . $tableauCreature[$cible]['pvActuel'] . " pv" . "\n");
                                    $fsObject->appendToFile($new_file_path, "\n");
                                }
                            }
                        }
                        $fsObject->appendToFile($new_file_path, "#######################\n\n");
                        $nbCible = $nbCible-1;
                    }while($nbCible>0);
                    $fsObject->appendToFile($new_file_path, "######################################################\n\n");
                }
            }
        }
        ///Fin du combat
        //dd($tableauCreature);
        if (empty($tableauHote)) {
            $fsObject->appendToFile($new_file_path, "\n");
            $fsObject->appendToFile($new_file_path, "\n");
            $fsObject->appendToFile($new_file_path, "###################################################\n");
            $fsObject->appendToFile($new_file_path, "############           Defaite           ############\n");
            $fsObject->appendToFile($new_file_path, "###################################################\n\n\n\n\n\n");
        } else {
            $fsObject->appendToFile($new_file_path, "###################################################\n");
            $fsObject->appendToFile($new_file_path, "############           Victoire           ############\n");
            $fsObject->appendToFile($new_file_path, "###################################################\n\n\n\n\n\n");
            //il faudrait recuperer les recompense associé au scenario
            $recompense = $scenario->getRecompense();
            //il faudrait ajouter les recoppense a la reputation de l'utilisateur
            for ($i = 0; ($i < count($tableauCreature)); $i++) {
                if ($tableauCreature[$i]['cote'] == 0) {
                    $tableauCreature[$i]['exp'] = $tableauCreature[$i]['exp'] + $recompense;
                    // modifier l'exp de l'hote en bdd
                    $fsObject->appendToFile($new_file_path, "" . $tableauCreature[$i]['nom'] . " à gagné " . $recompense . " pex" . "\n");
                }
            }
            for ($i = 0; $i < 5; $i++) {
                $pex = $tableauHotePex[$i]->getExp() + $recompense;
                $tableauHotePex[$i]->setExp($pex);
                //On verifie si les hotes passe un niveau
                if($tableauHotePex[$i]->getNiveau() < 10){
                    if ($tableauHotePex[$i]->getExp() >= $tableauHotePex[$i]->getNiveau()*100 ){
                        $tableauHotePex[$i]->setExp($tableauHotePex[$i]->getExp()-$tableauHotePex[$i]->getNiveau()*100);
                        $tableauHotePex[$i]->setNiveau($tableauHotePex[$i]->getNiveau()+1);
                        $this->NiveauPlus($tableauHotePex[$i]);
                    }
                }else{
                    if ($tableauHotePex[$i]->getExp() >= $tableauHotePex[$i]->getNiveau()*1000 ){
                        $tableauHotePex[$i]->setExp($tableauHotePex[$i]->getExp()-$tableauHotePex[$i]->getNiveau()*1000);
                        $tableauHotePex[$i]->setNiveau($tableauHotePex[$i]->getNiveau()+1);
                        $this->NiveauPlus($tableauHotePex[$i]);
                    }
                }
            }
            $reputation = $formation->getLienUser()->getReputation() + $recompense;
            $formation->getLienUser()->setReputation($reputation);
            $this->manager->persist($formation->getLienUser());
            $this->manager->persist($tableauHotePex[0]);
            $this->manager->persist($tableauHotePex[1]);
            $this->manager->persist($tableauHotePex[2]);
            $this->manager->persist($tableauHotePex[3]);
            $this->manager->persist($tableauHotePex[4]);
            $combat = $this->doctrine->getRepository(Combat::class)->findBy(['id' => $idCombat]);
            $combat[0]->setFichierLog($new_file_path);
            $this->manager->persist($combat[0]);
            $this->manager->flush();
            $fsObject->appendToFile($new_file_path, "" . $formation->getLienUser()->getPseudo() . " vous avez gagné " . $recompense . " de reputation, ce qui vous fait un total de " . $formation->getLienUser()->getReputation() . " reputation\n");
        }
    }
}
