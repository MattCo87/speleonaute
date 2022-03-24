<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class MailerTestController extends AbstractController
{
    /**
     * @Route("/mailertest", name="app_mailertest")
     */
    public function index(MailerInterface $mailer): Response
    {

        $email = (new Email())
            ->from('joel.obrecht@gmail.com')
            ->to('joel.obrecht@protonmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        for ($a = 1; $a <= 2; $a++) {
            $mailer->send($email);
            sleep(10);
        }

        return $this->render('mailer_test/index.html.twig', [
            'controller_name' => 'MailertestController',
        ]);

        // ...
    }
}
