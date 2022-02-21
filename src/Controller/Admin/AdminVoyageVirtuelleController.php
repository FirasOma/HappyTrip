<?php
namespace App\Controller\Admin;

use App\Entity\VoyageVirtuelle;
use App\Form\VoyageVirtuelleType;
use App\Repository\VoyageVirtuelleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminVoyageVirtuelleController extends AbstractController{
    /**
     * @var VoyageVirtuelleRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;


    /**
     * AdminVoyageVirtuelleController constructor.
     * @param VoyageVirtuelleRepository $repository
     */
    public function __construct(VoyageVirtuelleRepository $repository , EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route ("/adminVoyage" , name="admin.voyageVirtuelle.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(){
    $voyageVirtuelles=$this->repository->findAll();
    return $this->render('admin/voyageVirtuelle/index.html.twig' , compact('voyageVirtuelles'));
    }


    /**
     * @Route ("/admin/voyageVirtuelle/create" , name="admin.voyageVirtuelle.new")
     */
    public function new(Request $request)
    {
        $voyageVirtuelle = new VoyageVirtuelle();
        $form= $this->createForm(VoyageVirtuelleType::class , $voyageVirtuelle);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()){
            $this->em->persist($voyageVirtuelle);
            $this->em->flush();
            $this->addFlash('success' , 'Voyage crée avec succés');

            return $this->redirectToRoute('admin.voyageVirtuelle.index');
        }
        return $this->render('admin/voyageVirtuelle/new.html.twig' , [
            'voyageVirtuelle' =>$voyageVirtuelle,
            'form' =>$form->createView()
        ]);
    }



    /**
     * @Route("/adminVoyage/voyageVirtuelle/{id}" , name="admin.voyageVirtuelle.edit" , methods="GET|POST")
     * @param VoyageVirtuelle $voyageVirtuelle
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(VoyageVirtuelle $voyageVirtuelle, Request $request)
    {
        $form= $this->createForm(VoyageVirtuelleType::class , $voyageVirtuelle);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success' , 'Voyage modifié avec succés');
            return $this->redirectToRoute('admin.voyageVirtuelle.index');
        }


        return $this->render('admin/voyageVirtuelle/edit.html.twig' , [
            'voyageVirtuelle' =>$voyageVirtuelle,
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/adminVoyage/voyageVirtuelle/{id}" , name="admin.voyageVirtuelle.delete" , methods="DELETE")
     * @param VoyageVirtuelle $voyageVirtuelle
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(VoyageVirtuelle $voyageVirtuelle)
    {
        $this->em->remove($voyageVirtuelle);
        $this->em->flush();
        $this->addFlash('success' , 'Voyage supprimée avec succés');

        return $this->redirectToRoute('admin.voyageVirtuelle.index');
    }
}