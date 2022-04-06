<?php

namespace App\Controller\Admin;

use App\Entity\Action;
use App\Entity\ActionStrategie;
use App\Entity\CreatureFormation;
use App\Entity\Formation;
use App\Entity\Modele;
use App\Entity\PageVisiteur;
use App\Entity\Scenario;
use App\Entity\Statistique;
use App\Entity\StatistiqueModele;
use App\Entity\Strategie;
use App\Entity\StrategieModele;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Speleonaute');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Action', 'fas fa-list', Action::class);
        yield MenuItem::linkToCrud('ActionStrategie', 'fas fa-list', ActionStrategie::class);
        yield MenuItem::linkToCrud('Strategie', 'fas fa-list', Strategie::class);
        yield MenuItem::linkToCrud('StrategieModele', 'fas fa-list', StrategieModele::class);
        yield MenuItem::linkToCrud('Modele', 'fas fa-list', Modele::class);
        yield MenuItem::linkToCrud('StatistiqueModele', 'fas fa-list', StatistiqueModele::class);
        yield MenuItem::linkToCrud('Statistique', 'fas fa-list', Statistique::class);
        yield MenuItem::linkToCrud('CreatureFormation', 'fas fa-list', CreatureFormation::class);
        yield MenuItem::linkToCrud('Formation', 'fas fa-list', Formation::class);
        yield MenuItem::linkToCrud('Scenario', 'fas fa-list', Scenario::class);
        yield MenuItem::linkToCrud('PageVisiteur', 'fas fa-list', PageVisiteur::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
    }
}
