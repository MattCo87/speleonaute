<?php

namespace App\Controller;

use App\Entity\Combat;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BureauController extends AbstractController
{
    /**
     * @Route("/bureau", name="app_bureau")
     */
    public function index(): Response
    {
        return $this->render('bureau/index.html.twig', [
            'controller_name' => 'BureauController',
        ]);
    }

    /**
     * @Route("/bureau/log", name="app_bureau_log")
     */
    public function indexLog(ManagerRegistry $doctrine): Response
    {

        $tableauLog = array();
        $idLog = array();
        $i = 0;
        $combats = $doctrine->getRepository(Combat::class)->findAll();
        foreach( $combats as $combat ){
            $logTemp = $combat->getFichierLog();
            $buffer = [];
            if(false !== $handle = @fopen($logTemp, 'r')) {
                while (($word = fgets($handle)) !== false) {
                    $buffer[] = $word;
                }
                fclose($handle);
            }else{
                $buffer[] = "Pas de listes";
            }
            array_push($tableauLog, $buffer);
            array_push($idLog, $i);
            $i++;
        }
        return $this->render('bureau/log.html.twig', [
            'idLogs' => $idLog,
            'logs' => $tableauLog,
            'controller_name' => 'BureauController',
        ]);
    }

    /**
     * @Route("/bureau/classement", name="app_bureau_classement")
     */
    public function indexClassement(ManagerRegistry $doctrine): Response
    {
        $tableauJoueur = array();
        $joueurs = $doctrine->getRepository(User::class)->findAll();
        foreach( $joueurs as $joueur ){
            $joueurTemp['reputation'] = $joueur->getReputation();
            $joueurTemp['pseudo'] = $joueur->getPseudo();
            array_push($tableauJoueur, $joueurTemp);
        }

        $reputation = array();
            foreach ($tableauJoueur as $key => $row){
                $reputation[$key] = $row['reputation'];
            }
            array_multisort($reputation, SORT_DESC, $tableauJoueur);

        return $this->render('bureau/classement.html.twig', [
            'Joueurs' => $tableauJoueur,
        ]);
    }
}
