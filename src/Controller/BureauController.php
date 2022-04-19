<?php

namespace App\Controller;

use App\Entity\Combat;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;
/**
 * @IsGranted("ROLE_USER")
 */
class BureauController extends AbstractController
{
    private $security;

    function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/bureau", name="app_bureau")
     */
    public function indexLog(ManagerRegistry $doctrine): Response
    {
        $temp_user = $this->security->getUser();

        $tableauLog = array();
        $idLog = array();
        $i = 0;
        $combats = $doctrine->getRepository(Combat::class)->findAll();
        foreach ($combats as $combat) {
            $logTemp = $combat->getFichierLog();
            $buffer = [];
            //$buffer[] = '';
            if (false !== $handle = @fopen($logTemp, 'r')) {
                while (($word = fgets($handle)) !== false) {
                    $buffer[] = $word;
                }
                fclose($handle);
            } else {
                $buffer[] = "Pas de listes";
            }
            array_push($tableauLog, $buffer);
            //array_push($idLog, $i);
            $idLog[$i][0] = $i;
            $idLog[$i][1] = $buffer;
            $i++;
        }
        //dd($idLog);
        /*************************************************************************************** */
        if (isset($_GET['idlog'])) {
            foreach ($idLog as $var_log) {
                if ($var_log[0] == $_GET['idlog']) {
                    $infolog = $var_log;
                }
            }
        } else {
            $infolog = 'Pas de combat';
        }
        /************************************************************************************************ */
        //dd($infolog[1]);
        return $this->render('bureau/log.html.twig', [
            'profil'    => $temp_user,
            'idLogs' => $idLog,
            'logs' => $tableauLog,
            'infolog' => $infolog[1],
        ]);
    }

    /**
     * @Route("/bureau/classement", name="app_bureau_classement")
     */
    public function indexClassement(ManagerRegistry $doctrine): Response
    {
        $temp_user = $this->security->getUser();
        $tableauJoueur = array();
        $joueurs = $doctrine->getRepository(User::class)->findAll();
        foreach ($joueurs as $joueur) {
            $joueurTemp['reputation'] = $joueur->getReputation();
            $joueurTemp['pseudo'] = $joueur->getPseudo();
            array_push($tableauJoueur, $joueurTemp);
        }

        $reputation = array();
        foreach ($tableauJoueur as $key => $row) {
            $reputation[$key] = $row['reputation'];
        }
        array_multisort($reputation, SORT_DESC, $tableauJoueur);

        return $this->render('bureau/classement.html.twig', [
            'profil'    => $temp_user,
            'Joueurs' => $tableauJoueur,
        ]);
    }
}
