<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;
use App\Entity\User;
use App\Entity\Reclamation;

class AdminHomeController extends AbstractController
{
    /**
     * @Route("/adminhome", name="adminhome")
     */
    public function adminHomepage(): Response
    {
        return $this->render('homeadmin.html.twig', [
            'controller_name' => 'AdminHomeController',
        ]);
    }
/**
* @Route("/adminhome/list_users", name="list_users")
*/
    public function adminAllUsers(): Response {
        $users = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        return $this->render('listusers.html.twig', array(
        'users' => $users,
));
    }

/**
* @Route("/adminhome/list_hotels", name="list_hotels")
*/
public function adminAllHotels(): Response {
$hotels = $this->getDoctrine()->getManager()->getRepository(Hotel::class)->findAll();
return $this->render('listhotels.html.twig', array(
'hotels' => $hotels,
));
}

/**
* @Route("/adminhome/reports", name="list_reports")
*/
public function adminAllReports(): Response {
$reports = $this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findAll();
return $this->render('reclamations.html.twig', array(
'reports' => $reports,
));
}

}