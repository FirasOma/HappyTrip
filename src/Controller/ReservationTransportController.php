<?php

namespace App\Controller;

use App\Entity\ReservationTransport;
use App\Form\ReservationTransportType;
use App\Repository\ReservationTransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReservationTransportController extends AbstractController
{
    
    /**
     * @Route("/reservationtrr", name="reservation")
     */
    public function index(Request $request)
    {
        $form= $this->createForm(ReservationTransportType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            
            $reservationtransport = new ReservationTransport();
            $form = $this->createForm(ReservationTransportType::class, $reservationtransport);
            $form->handleRequest($request);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservationtransport);
            $entityManager->flush();
            $contact=$form->getData();

                return $this->redirectToRoute('reservation');
             
        }
        return $this->render('reservation_transport/index.html.twig', [
            'reservationtransportForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/listereservationt", name="reservation_listt", methods={"GET"})
     */
    public function listereservationtransport(ReservationTransportRepository $reservationtransportRepository): Response
    {
        
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $reservationtransport =  $reservationtransportRepository->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reservation_transport/listereservationtransport.html.twig', [
            'reservationtransports' => $reservationtransport,
        
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("ListeReservationTransport.pdf", [
            "Attachment" => false
        ]);
    }
}
