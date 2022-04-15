<?php

namespace App\Controller;

use App\Repository\CreatureRepository;
use App\Repository\ModeleRepository;
use App\Entity\User;
use App\Entity\Formation;
use App\Entity\CreatureFormation;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{

    private $emm;
    private $emc;

    function __construct(CreatureRepository $emc, ModeleRepository $emm)
    {
        $this->emm = $emm;
        $this->emc = $emc;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // J'affecte 5 nouveaux personnages à l'utilisateur 
            $modele = $this->emm->findBy(['ouvrable' => 1]);

            for ($i = 0; $i < 5; $i++) {

                $taille = count($modele)-1;
                $a = rand(0, $taille);

                // Je crée une nouvelle créature
                $creature = $this->emc->makeCreature($modele[$a]);
                $creature->setLienUser($user);
                $tab_creature[] = $creature;
                $entityManager->persist($creature);
            }

            // Je crée une formation
            $var_formation = new Formation;
            $var_formation_name = 'Speleo' . ucfirst(str_replace(' ', '', $user->getPseudo()));
            $var_formation->setNom($var_formation_name);
            $var_formation->setLienUser($user);            
            $entityManager->persist($var_formation);
/*
            // Puis une deuxième pour l'exemple
            $var_formation2 = new Formation;
            $var_formation2_name = ucfirst(str_replace(' ', '', $user->getPseudo())). "Boyz";
            $var_formation2->setNom($var_formation2_name);
            $var_formation2->setLienUser($user);            
            $entityManager->persist($var_formation2);
*/
            $z = 0;
            // J'affecte les personnages de l'utilisateur à la formation
            foreach ($tab_creature as $var_creature){
                $z++;
                $var_creatureformation = new CreatureFormation;
                $var_creatureformation->setLienCreature($var_creature);
                $var_creatureformation->setLienFormation($var_formation);
                $var_creatureformation->setStrategie(1);
                if($z<4){
                    $var_creatureformation->setLocalisation(1);
                }
                if($z==4){
                    $var_creatureformation->setLocalisation(2);
                }
                if($z==5){
                    $var_creatureformation->setLocalisation(3);
                }
                
                $entityManager->persist($var_creatureformation);
            }



            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
