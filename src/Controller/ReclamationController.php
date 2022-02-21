<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Entity\User;

/**
 *
 * @Route ("/report")
 */
class ReclamationController extends AbstractController
{

  /**
   * @Route("/add-report", name="app_report")
   */
    public function addReclamation(Request $request) {
      $reclamation = new Reclamation();
      $form = $this->createForm(ReclamationType::class, $reclamation);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $stars_number= $_POST['note'];
        $reclamation->setUser($this->getUser());
        $reclamation->setStarsNumber($stars_number);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reclamation);
        $entityManager->flush();
        $message = "Your report has been sent !";
      } else {
        $message = null;
      }
      return $this->render('reclamation/report.html.twig', [
          'reportForm' => $form->createView(),
          'message' => $message
      ]);
    }

    /**
     * @Route("/success", name="report_success")
     */
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig');
    }
}
