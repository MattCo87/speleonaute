<?php

namespace App\Controller;

use App\Entity\Creature;
use App\Entity\CreatureFormation;
use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CreatureFormationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Security;
use App\Repository\CreatureRepository;
use App\Repository\FormationRepository;
use App\Repository\CreatureFormationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 */
class FormationController extends AbstractController
{
    private $security;
    private $emf;
    private $emc;
    private $emcf;

    public function __construct(Security $security, FormationRepository $emf, CreatureRepository $emc, CreatureFormationRepository $emcf)
    {
        $this->security = $security;
        $this->emf = $emf;
        $this->emc = $emc;
        $this->emcf = $emcf;
    }

    /**
     * @Route("/delete/{formation}/{creature}", name="app_formation_delete")
     */

    public function delete(Formation $formation, Creature $creature)
    {
        // On récupére l'ID de la formation
        $formation = $formation->getId();
        // On récupére l'ID de la créature
        $creature = $creature->getId();

        // On récupére l'objet correspondant à la formation et à la créature
        $temp_del_formation = $this->emcf->findBy(['lienFormation' => $formation, 'lienCreature' => $creature]);
        $del_formation = $temp_del_formation[0]->getId();
        // var_dump($del_formation);

        $this->emcf->remove($temp_del_formation[0]);

        return $this->redirectToRoute('app_formation');
    }

    /**
     * @Route("/formation", name="app_formation")
     */
    public function index(Request $request, ValidatorInterface $validator, EntityManagerInterface $manager): Response
    {
        // On récupére l'utilisateur courant
        $temp_user = $this->security->getUser();
        $var_user = $temp_user->getId();

        // On récupére toutes les formations de l'utilisateur courant
        $var_formation = $this->emf->findByUser($var_user);

        /*********************                   ************************************************************************ */
        /*********************                   ************************************************************************ */
        /*********************                   ************************************************************************ */

        // On récupére tous les personnages de chaque formation
        $i = 0;
        foreach ($var_formation as $formation) {
            $var_id = $formation['id'];
            // On récupére le nom de la formation
            $temp_formation = $this->emf->findBy(['id' => $var_id]);
            $formation_nm = $temp_formation[0]->getNom();

            // On récupére les informations des personnages dans la formation

            // ID formation, important pour l'action de la fiche du personnage
            $tab_formation[$i]['id'] = $temp_formation[0]->getId();
            // On récupére le nom parce que c'est plus beau à l'affichage
            $tab_formation[$i]['nom'] = $formation_nm;
            // On récupére la liste des créatures dans la formation
            $tab_formation[$i]['composition'] = $this->emc->getFormationCreatures2($var_id);

            /******************************************************************************************************************** */
            // On ajoute au tableau des informations du personnage, sa stratégie et sa localisation

            for ($j = 0; $j < count($tab_formation[$i]['composition']); $j++) {

                // On récupére le personnage dans le tableau
                $temp_num_creature = $tab_formation[$i]['composition'];
                $num_creature = $temp_num_creature[$j]['id'];

                // Ici sa localisation dans l'entity CreatureFormation
                $temp_formationcreature = $this->emcf->findBy(['lienFormation' => $var_id, 'lienCreature' => $num_creature]);
                $creature_position = $temp_formationcreature[0]->getLocalisation();
                // Là sa stratégie dans l'entity CreatureFormation
                $creature_strategie = $temp_formationcreature[0]->getStrategie();

                /* On met tout dans un tableau pour l'afficher en twig
                Pour rappel :
                        $tab_formation[$i]['composition'] = $this->emc->getFormationCreatures2($var_id);
                Récupére les infos du personnage, mais pas sa situation dans le formation ( position + stratrégie )
                */
                $tab_formation[$i]['composition'][$j]['position'] = $creature_position;
                $tab_formation[$i]['composition'][$j]['strategie'] = $creature_strategie;
            }
            $i++;
        }

        //dd($tab_formation);
        /*********************                   ************************************************************************ */
        /*********************                   ************************************************************************ */
        /*********************                   ************************************************************************ */








        /*********************                   ************************************************************************ */
        /*********************                   ************************************************************************ */
        /*********************                   ************************************************************************ */

        // Ajout d'une créature dans une formation

        // On crée une CreatureFormation
        $creatureFormation = new CreatureFormation();

        //On crée le formulaire de création de CreatureFormation
        $form = $this->createForm(CreatureFormationType::class, $creatureFormation);
        $form->handleRequest($request);

        // Action sur la validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            // On teste si le couple "formation/creature" existe
            $tmp_creature =  $_REQUEST['creature_formation']['lienCreature'];
            $tmp_formation = $_REQUEST['creature_formation']['lienFormation'];

            // Si c'est 1, ok la formation existe, si c'est 0, y'a pas de formation qui existe
            $existCreatureFormation = $this->emcf->existCreatureFormation($tmp_formation, $tmp_creature);

            // On teste s'il y'a de la place à prendre dans la formation ( < 5)
            $var_rap = $this->emcf->findBy(['lienFormation' => $tmp_formation]);
            $rap = count($var_rap);
            //    dd($rap);
            if ($rap < 5) {
                if ($existCreatureFormation == 1) {
                    /* On peut ajouter du code ICI genre
                un message d'erreur ou un truc super sympa mais j'ai pas d'idée   ou
                un peu comme un connard, genre, si tu t'es trompé, c'est ta life ...
                mais pour l'instant il ne se passe rien du tout ^^ ^^ ^^
                */
                } else {
                    // On ajoute la CreatureFormation 
                    $manager->persist($creatureFormation);
                    $manager->flush();
                }
            }
            return $this->redirectToRoute('app_formation');
        }

        /*********************                   ************************************************************************ */
        /*********************                   ************************************************************************ */
        /*********************                   ************************************************************************ */

        return $this->render('formation/index.html.twig', [
            'form' => $form->createView(),
            'tabformations' => $tab_formation,
        ]);
    }
}
