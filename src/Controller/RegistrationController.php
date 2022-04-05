<?php

namespace App\Controller;

use App\Repository\CreatureRepository;
use App\Repository\ModeleRepository;
use App\Entity\User;
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
            for ($i = 0; $i < 5; $i++) {

                // Je choisis un modèle au hasard
                $modele = $this->emm->find(rand(1, 7));

                // Je crée une nouvelle créature
                $creature = $this->emc->makeCreature($modele);
                $creature->setLienUser($user);
                $entityManager->persist($creature);
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
