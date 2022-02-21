<?php
namespace App\Controller\Admin;

use App\Entity\Destination;
use App\Form\DestinationType;
use App\Repository\DestinationRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Request;

class AdminDestinationController extends AbstractController{
    /**
     * @var DestinationRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;


    /**
     * AdminDestinationController constructor.
     * @param DestinationRepository $repository
     * @param ObjectManager $em
     */
    public function __construct(DestinationRepository $repository , EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }



    /**
     * @Route ("/adminn" , name="admin.destination.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
    $destinations = $this->repository->findAll();
    return $this->render('admin/destination/index.html.twig' , compact('destinations'));
    }
    /**
     * @Route ("admin/destination/create" , name="admin.destination.new")
     */
    public function new(Request $request)
    {
        $destination= new Destination();
        $form = $this->createForm(DestinationType::class , $destination);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($destination);
            $this->em->flush();
            $this->addFlash('success', 'Destination crée avec succée');

            return $this->redirectToRoute('admin.destination.index');
        }
        return $this->render('admin/destination/new.html.twig' , [
            'destination' => $destination ,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/destination/{id}" , name="admin.destination.edit" , methods="GET|POST")
     * @param Destination $destination
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Destination $destination , Request $request)
    {
        $form = $this->createForm(DestinationType::class , $destination);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Destination modifiée avec succée');
            return $this->redirectToRoute('admin.destination.index');
        }

        return $this->render('admin/destination/edit.html.twig' , [
            'destination' => $destination ,
            'form' => $form->createView()
        ]);


    }

    /**
     * @Route("/admin/destination/{id}" , name="admin.destination.delete" , methods="DELETE")
     * @param Destination $destination
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function delete(Destination $destination)
    {
        $this->em->remove($destination);
        $this->em->flush();
        $this->addFlash('success', 'Destination supprimée avec succée');

        return $this->redirectToRoute('admin.destination.index');
    }
}