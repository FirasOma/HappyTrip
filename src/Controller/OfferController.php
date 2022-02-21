<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/offre")
 */
class OfferController extends AbstractController
{
    /**
     * @var Environment
     * OfferController constructor.
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param OfferRepository $Offerrep
     * @return Response
     * @Route("/all" , name="showOffer")
     */
    public function Show(Request $request, PaginatorInterface $paginator, OfferRepository $Offerrep): Response
    {
        $offers = new Offer();
        $offer[] = new Offer();
// line below returns null as if the $_GET param hasn't been mapped to variable in function def $q
        $q = $request->get('q', null);
        $em = $this->getDoctrine()->getManager();
        if (empty($q)) {
            $offer = $em->getRepository(Offer::class)->findAll();
            $offer = $paginator->paginate(
                $offer,
                $request->query->getInt('page', 1),
                2
            );
        } else {
            $offers = $Offerrep->findOneBy($q);
            $offer = $paginator->paginate(
                $offers,
                $request->query->getInt('page', 1),
                3
            );
        }
        return $this->render('offer/show.html.twig', ['offers' => $offer, 'offerssearch' => $offers, 'search' => $q]);
    }

    /**
     * @param OfferRepository
     * @return Response
     * @Route("/details/{id}",name="detailOffer")
     */
    public function detail($id, OfferRepository $repository)
    {
        $detail = $repository->find($id);
        return $this->render('offer/detail.html.twig', [
            'details' => $detail]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/add",name="add")
     */

    public function add(Request $request)
    {
        $offer = new Offer();
        $form=$this->createForm(OfferType::class, $offer);
        $form->add('add', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();
            return $this->redirectToRoute('showoffer');
        }

        return $this->render('offer/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("edit/{id}",name="edit")
     */
    function edit($id,OfferRepository $repository,Request $request)
    {
        $offer=$repository->find($id);
        $form=$this->createForm(OfferType::class,$offer);
        $form->add('edit',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('showoffer');
        }
        return $this->render('offer/edit.html.twig',
            ['f'=>$form->createView()]);
    }

}
