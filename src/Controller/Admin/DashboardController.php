<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Equipe;
use App\Entity\Joueur;
use App\Entity\Planning;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/adminrfadmin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(ArticleCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Reformed Family');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToRoute('Se rendre sur le site', 'fa fa-window-maximize', 'app_index');
        yield MenuItem::linkToCrud('Article', 'fas fa-newspaper', Article::class);
        yield MenuItem::linkToCrud('Equipe', 'fa fa-gamepad', Equipe::class);
        yield MenuItem::linkToCrud('Commentaire', 'fa fa-comments', Commentaire::class);
        yield MenuItem::linkToCrud('Joueur', 'fas fa-users', Joueur::class);
        yield MenuItem::linkToCrud('Planning', 'fa fa-calendar', Planning::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
    }
}
