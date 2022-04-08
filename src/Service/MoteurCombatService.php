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

class MoteurCombatService extends ServiceEntityRepository
{
    private $doctrine;
    private $emm;
    private $emsm;

    function __construct(ManagerRegistry $doctrine, EntityManagerInterface $manager, ModeleRepository $emm, StatistiqueModeleRepository $emsm)
    {
        $this->doctrine = $doctrine;
        $this->manager = $manager;
        $this->emm = $emm;
        $this->emsm = $emsm;
    }


    public function NiveauPlus()
    {
        // On récupére le modèle
        $tab_stat = $this->emsm->findBy(['lienModele' => 1]);

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
        var_dump($tab_tas);

        // On choisit la stat et on ajoute 1 point
        for ($z = 0; $z < 5; $z++) {
            $alea = rand(0, $total_points);
            $tab_final[] = $tab_tas[$alea];
        }
        dd($tab_final);
    }


    public function combat(Formation $formation, Scenario $scenario, int $idCombat)
    {
        $this->NiveauPlus();
        $nomCombat = "" . $formation->getLienUser()->getEmail() . "_Combat_" . $idCombat . "";
        $id = $formation->getId();
        //Tableau Hote
        $tableauHote = array();
        $tableauHotePex = array();
        $tiersCrea = $this->doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $id]);
        foreach ($tiersCrea as $crea) {
            $idCrea = $crea->getlienCreature();
            array_push($tableauHotePex, $idCrea);
            array_push($tableauHote, $idCrea->getId());
        }
        //Tableau monstre
        $idScenario = $scenario->getlienFormation()->getId();
        $tableauMonstre = array();
        $tiersCrea2 = $this->doctrine->getRepository(CreatureFormation::class)->findBy(['lienFormation' => $idScenario]);
        foreach ($tiersCrea2 as $crea) {
            $idCrea2 = $crea->getlienCreature();
            array_push($tableauMonstre, $idCrea2->getId());
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
                $Creature2['idModele'] = $crea->getlienModele()->getId();
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
            array_push($tableauCreature, $Creature2);
        }
        foreach ($tableauMonstre as $monstre) {
            $creature = $this->doctrine->getRepository(Creature::class)->findBy(['id' => $monstre]);
            foreach ($creature as $crea) {
                $Creature2['id'] = $crea->getId();
                $Creature2['nom'] = $crea->getNom();
                $Creature2['niveau'] = $crea->getNiveau();
                $Creature2['exp'] = $crea->getExp();
                $Creature2['idModele'] = $crea->getlienModele()->getId();
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
        while (($tour < 50) && ($alliéVivant < 5) && ($ennemiVivant < 5)) {
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
                if ($creature['pvActuel'] > 0 && $alliéVivant < 5 && $ennemiVivant < 5) {
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
                    if ($creature['cote'] == 0) {
                        do {
                            $taille = count($tableauMonstre) - 1;
                            $a = rand(0, $taille);
                            $idCible = $tableauMonstre[$a];
                            $cible = 0;
                            $tableauCreatureCopie = $tableauCreature;
                            foreach ($tableauCreatureCopie as $creatureCopie) {
                                if ($creatureCopie['id'] == $idCible) {
                                    break;
                                } else {
                                    $cible++;
                                }
                            }
                            if ($tableauCreature[$cible]['pvActuel'] > 0) {
                                $isOk = 1;
                            } else {
                                $isOk = 0;
                            }
                        } while ($isOk == 0);
                    }
                    if ($creature['cote'] == 1) {
                        do {
                            $taille = count($tableauHote) - 1;
                            $a = rand(0, $taille);
                            $idCible = $tableauHote[$a];
                            $cible = 0;
                            $tableauCreatureCopie = $tableauCreature;
                            foreach ($tableauCreatureCopie as $creatureCopie) {
                                if ($creatureCopie['id'] == $idCible) {
                                    break;
                                } else {
                                    $cible++;
                                }
                            }
                            if ($tableauCreature[$cible]['pvActuel'] > 0) {
                                $isOk = 1;
                            } else {
                                $isOk = 0;
                            }
                        } while ($isOk == 0);
                    }
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
                            $fsObject->appendToFile($new_file_path, "" . $tableauCreature[$cible]['nom'] . " à subit " . $degatSubit . " de degat" . "\n");
                            $fsObject->appendToFile($new_file_path, "\n");
                            $tableauCreature[$cible]['pvActuel'] = $tableauCreature[$cible]['pvActuel'] - $degatSubit;
                            if ($tableauCreature[$cible]['pvActuel'] <= 0) {
                                $fsObject->appendToFile($new_file_path, "" . $tableauCreature[$cible]['nom'] . " est mort au combat" . "\n");
                                $fsObject->appendToFile($new_file_path, "\n");
                                if ($tableauCreature[$cible]['cote'] == 0) {
                                    $alliéVivant++;
                                } else {
                                    $ennemiVivant++;
                                }
                            } else {
                                $fsObject->appendToFile($new_file_path, "" . $tableauCreature[$cible]['nom'] . " survit avec " . $tableauCreature[$cible]['pvActuel'] . " pv" . "\n");
                                $fsObject->appendToFile($new_file_path, "\n");
                            }
                        }
                    }
                    $fsObject->appendToFile($new_file_path, "######################################################\n\n");
                }
            }
        }
        ///Fin du combat
        if ($alliéVivant == 5) {
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
