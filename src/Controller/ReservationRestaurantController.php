<?php

namespace App\Controller;

use App\Entity\ReservationRestaurant;
use App\Form\ReservationRestaurantType;
use App\Repository\ReservationRestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Dompdf\Dompdf;
use Dompdf\Options;


class ReservationRestaurantController extends AbstractController
{
    /**
     * @Route("/reservationres", name="reservationres")
     */
    public function index(Request $request)
    {
        $form= $this->createForm(ReservationRestaurantType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            
            $reservationrestaurant = new ReservationRestaurant();
            $form = $this->createForm(ReservationRestaurantType::class, $reservationrestaurant);
            $form->handleRequest($request);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservationrestaurant);
            $entityManager->flush();
            $reservationrestaurant=$form->getData();
    

                return $this->redirectToRoute('reservationres');
             
        }
        return $this->render('reservation_restaurant/index.html.twig', [
            'reservationrestaurantForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/listereservation", name="reservation_list", methods={"GET"})
     */
    public function listereservation(ReservationRestaurantRepository $reservationrestaurantRepository): Response
    {
        
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $reservationrestaurant =  $reservationrestaurantRepository->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reservation_restaurant/listereservation.html.twig', [
            'reservationrestaurants' => $reservationrestaurant,
        
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("ListeReservation.pdf", [
            "Attachment" => false
        ]);
    }

}
