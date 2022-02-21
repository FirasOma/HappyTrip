<?php

namespace App\Controller;

use App\Entity\Transport;
use App\Form\TransportType;
use App\Repository\TransportRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/transport")
 */
class TransportController extends AbstractController
{
    /**
     * @Route("/", name="transport_index", methods={"GET"})
     */
    public function index(TransportRepository $transportRepository): Response
    {
        return $this->render('transport/index.html.twig', [
            'transports' => $transportRepository->findAll(),
        ]);
    }

    /**
     * @Route("/listetransport", name="reservation_listt", methods={"GET"})
     */
    public function listetransport(TransportRepository $transportRepository): Response
    {
        
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $transport =  $transportRepository->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('transport/listetransport.html.twig', [
            'transports' => $transport,
        
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("ListeTransport.pdf", [
            "Attachment" => false
        ]);
    }

    /**
     * @Route("/new", name="transport_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $transport = new Transport();
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($transport);
            $entityManager->flush();

            return $this->redirectToRoute('transport_index');
        }

        return $this->render('transport/new.html.twig', [
            'transport' => $transport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show_transport", methods={"GET"})
     */
    public function show(Transport $transport): Response
    {
        return $this->render('transport/show.html.twig', [
            'transport' => $transport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="transport_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transport $transport): Response
    {
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transport_index');
        }

        return $this->render('transport/edit.html.twig', [
            'transport' => $transport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transport_delete", methods={"POST"})
     */
    public function delete(Request $request, Transport $transport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transport->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('transport_index');
    }
}
