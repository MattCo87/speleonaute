<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CreatureRepository;
use App\Repository\ModeleRepository;
use App\Repository\StatistiqueCreatureRepository;
use App\Repository\StrategieModeleRepository;
use App\Repository\ActionStrategieRepository;

use Symfony\Component\Security\Core\Security;

class EntrepotController extends AbstractController
{
    private $security;
    private $emc;
    private $emsc;
    private $emm;
    private $emsm;
    private $emas;


    public function __construct(Security $security, CreatureRepository $emc, ModeleRepository $emm, StatistiqueCreatureRepository $emsc, StrategieModeleRepository $emsm, ActionStrategieRepository $emas)
    {
        $this->security = $security;
        $this->emc = $emc;
        $this->emm = $emm;
        $this->emsc = $emsc;
        $this->emsm = $emsm;
        $this->emas = $emas;
    }


    /**
     * @Route("/entrepot", name="app_entrepot")
     */
    public function index()
    {
        // On teste si une créature a déjà été choisie
        if (!(isset($_GET['idcreature']))) {
            $idcreature = 'Choisissez une créature à droite pour afficher ses informations';
            $infocreature = '';
            $creatureOK = 0;
        } else {
            $idcreature = $_GET['idcreature'];
            $creatureOK = 1;
        }

        /*********************************************************************************************************** */
        // On récupére la liste des créatures appartenant à l'utilisateur courant
        $temp_user = $this->security->getUser();
        $var_user = $temp_user->getId();

        // On récupére toutes les formations de l'utilisateur courant
        $tab_creature = $this->emc->findByUser($var_user);

        // On compléte le tableau des informations pour chaque créatures
        $i = 0;
        foreach ($tab_creature as $creature) {
            // On récupére les infos du modèle référent de la créatures
            $var_modele = $this->emm->find(intval($creature['lien_modele_id']));
            $tab_creature[$i]['rarete'] = $var_modele->getRarete();
            $tab_creature[$i]['pointNiv'] = $var_modele->getPointNiv();

            // On récupére toutes les statistiques
            $var_stats = $this->emsc->findBy(['lienCreature' => intval($creature['id'])]);

            // Pour chaque stat, on récupére son nom et sa valeur, et on ajoute au tableau des créatures
            foreach ($var_stats as $stat) {
                $var_stat_nom = $stat->getLienStatistique()->getNom();
                $tab_creature[$i][$var_stat_nom] = $stat->getValeur();
            }

            // On récupére les statégies et les actions liées
            $var_strategie = $this->emsm->findBy(['lienModele' => intval($creature['lien_modele_id'])]);
            $j = 1;
            foreach ($var_strategie as $strategie) {
                $tab_creature[$i]['strategie' . $j] = $strategie->getLienStrategie()->getNom();

                // On recherche les actions liées à chaque stratégie
                $var_actions = $this->emas->findBy(['lienStrategie' => intval($strategie->getLienStrategie()->getId())]);
                $z = 0;
                foreach ($var_actions as $action) {

                    // On crée un tableau listant les caractéristiques de chaque action
                    $tab_var_actions[$z]['nom'] = $action->getLienAction()->getNom();
                    $tab_var_actions[$z]['toucher'] = $action->getLienAction()->getToucher();
                    $tab_var_actions[$z]['tier'] = $action->getLienAction()->getTier();
                    $tab_var_actions[$z]['degat'] = $action->getLienAction()->getDegat();

                    // On ajoute ce tableau au tableau de la créature
                    $tab_creature[$i]['Actionstrategie' . $j][] = $tab_var_actions[$z];
                    $z++;
                }
                $j++;
            }
            $i++;
        }
        // dd($tab_creature);
        /********************************************************************************************************************* */

        if ($creatureOK == 1) {
            foreach ($tab_creature as $creature) {
                if ($creature['id'] == $idcreature) {
                    $infocreature = $creature;

                }
            }
        }
//dd($infocreature);
        return $this->render('entrepot/index.html.twig', [
            'tabcreatures' => $tab_creature,
            'idcreature' => $idcreature,
            'infocreature' => $infocreature,
        ]);
    }
}
