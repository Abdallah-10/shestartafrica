<?php

namespace App\Controller\Admin;

use App\Entity\Events;
use App\Entity\Expert;
use App\Entity\Inscreption;
use App\Entity\Investor;
use App\Entity\Mentor;
use App\Entity\News;
use App\Entity\Testimonial;
use App\Entity\Training;
use App\Entity\User;
use App\Entity\Ventures;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractDashboardController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin/", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SheStartAfrica');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Ventures', 'fa fa-shapes', Ventures::class);
        yield MenuItem::linkToCrud('Trainings', 'fas fa-award', Training::class);
        yield MenuItem::linkToCrud('Investors', 'fas fa-handshake', Investor::class);
        yield MenuItem::linkToCrud('Mentors', 'fas fa-clipboard', Mentor::class);
        yield MenuItem::linkToCrud('Experts', 'fas fa-clipboard', Expert::class);
        yield MenuItem::linkToCrud('News', 'fas fa-list', News::class);
        yield MenuItem::linkToCrud('Events', 'fa fa-eye', Events::class);
        yield MenuItem::linkToCrud('Registrations', 'fa fa-business-time', Inscreption::class);
        yield MenuItem::linkToCrud('Testimonials', 'fa fa-list', Testimonial::class);
    }
}
