<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Entity\Categorie;
use App\Entity\Contact;
use App\Entity\Projet;
use App\Entity\Experience;
use App\Entity\Formation;
use App\Entity\Temoignage;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable

    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('projets', 'fas fa-code', Projet::class);
        yield MenuItem::linkToCrud('catégories', 'fas fa-shield-heart', Categorie::class);
        yield MenuItem::linkToCrud('actualités', 'fa-brands fa-linkedin', Actualite::class);
        yield MenuItem::linkToCrud('expériences', 'fa-solid fa-inbox', Experience::class);
        yield MenuItem::linkToCrud('formations', 'fas fa-book', Formation::class);
        if ($this->isGranted('ROLE_EDITOR') && '...') {
            yield MenuItem::linkToCrud('témoignages', 'fa-solid fa-heart', Temoignage::class) ->setPermission('ROLE_EDITOR');
        }
        
        yield MenuItem::linkToCrud('utilisateurs', 'fa-solid fa-users', User::class);
    }
}
