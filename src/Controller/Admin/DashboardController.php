<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Destination;
use App\Entity\Event;
use App\Entity\Offer;
use App\Entity\ReservationRestaurant;
use App\Entity\ReservationTransport;
use App\Entity\Restaurant;
use App\Entity\VoyageVirtuelle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;
use App\Entity\Reclamation;
use App\Entity\User;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
      $routeBuilder = $this->get(AdminUrlGenerator::class);

      return $this->redirect($routeBuilder->setController(ReclamationCrudController::class)->generateUrl());
    }

    public function configureMenuItems(): iterable {
      yield MenuItem::section('Management');
      yield MenuItem::linkToCrud('Hotels', 'fas fa-hotel', Hotel::class);
      yield MenuItem::linkToCrud('Reclamations', 'fas fa-ban', Reclamation::class);
      yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
      yield MenuItem::linkToCrud('Event', 'far fa-calendar-check', Event::class);
      yield MenuItem::linkToCrud('Offer', 'fas fa-gifts', Offer::class);
      yield MenuItem::linkToCrud('Offer', 'fas fa-gifts', Offer::class);
      yield MenuItem::linkToCrud('Destinations', 'fa fa-map', Destination::class);
      yield MenuItem::linkToCrud('VoyageVirtuelles', 'fa fa-video', VoyageVirtuelle::class);
      yield MenuItem::linkToCrud('ReservationTrasnport', 'fas fa-address-book', ReservationTransport::class);
      yield MenuItem::linkToCrud('Restaurant', 'fas fa-utensils', Restaurant::class);
      yield MenuItem::linkToCrud('ReservationRestaurant', 'fas fa-address-book', ReservationRestaurant::class);
      yield MenuItem::linkToCrud('Contact', 'fas fa-exclamation-triangle', Contact::class);




    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Happy Trip <i class = "fa fa-plane"></i>');
    }
}
