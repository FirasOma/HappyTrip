<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Entity\VoyageVirtuelle;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\VoyageVirtuelleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoyageVirtuelleController extends AbstractController {
    /**
     * @var VoyageVirtuelleRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;


    /**
     * VoyageVirtuelleController constructor.
     */
    public function __construct(VoyageVirtuelleRepository $repository , EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route ("/VoyageVirtuelle" , name="VoyageVirtuelle.index")
     * @return Response
     */
    public function index(Request $request , \Swift_Mailer $mailer, ContactNotification $notification):Response{

        $voyageVirtuelles = $this->repository->findAll();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $this->addFlash('success', "Votre email a ete bien envoyé ");
            /*
            return $this->redirectToRoute('VoyageVirtuelle.index',[
                    'voyageVirtuelles' => $voyageVirtuelles,
                    'current_menu' => 'voyagevirtuelle',
                    'form' => $form->createView()
         ]);*/
        }

        return $this->render('VoyageVirtuelle/index.html.twig' , [
            'voyageVirtuelles' => $voyageVirtuelles,
            'current_menu' => 'voyagevirtuelle',
            'form' => $form->createView()
        ]);
    }
}