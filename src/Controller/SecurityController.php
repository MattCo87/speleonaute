<?php

namespace App\Controller;

use App\Repository\PageVisiteurRepository;
use PharIo\Manifest\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, PageVisiteurRepository $pageVisiteurRepository): Response
    {
        /*if ($this->getUser()->getRoles() == "ROLE_ADMIN") {
            return $this->redirectToRoute('admin');
        }*/
        
        if ($this->getUser()) {
            if($this->getUser()->getRoles()[0] == "ROLE_ADMIN"){
                return $this->redirectToRoute('admin');
            }
            return $this->redirectToRoute('app_hub');
        }

        $pageContent = $pageVisiteurRepository->findOneBy(['titre' => 'Accueil']);;

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'contenu_page' => $pageContent]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
