<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/events")
 */
class EventController extends AbstractController
{
    /**
     * @var Environment
     * EventController constructor.
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param EventRepository $Eventrep
     * @return Response
     * @Route("/all" , name="showEvent")
     */
    public function Show(Request $request, PaginatorInterface $paginator, EventRepository $Eventrep): Response
    {
        $events = new Event();
        $event[] = new Event();
// line below returns null as if the $_GET param hasn't been mapped to variable in function def $q
        $q = $request->get('q', null);
        $em = $this->getDoctrine()->getManager();
        if (empty($q)) {
            $event = $em->getRepository(Event::class)->findAll();
            $event = $paginator->paginate(
                $event,
                $request->query->getInt('page', 1),
                3
            );
        } else {
            $events = $Eventrep->findOneBy($q);
            $event = $paginator->paginate(
                $events,
                $request->query->getInt('page', 1),
                3
            );
        }
        return $this->render('event/show.html.twig', ['events' => $event, 'eventssearch' => $events, 'search' => $q]);
    }

    /**
     * @param EventRepository
     * @return Response
     * @Route("/details/{id}",name="detailEvent")
     */
    public function detail($id, EventRepository $repository)
    {
        $detail = $repository->find($id);
        return $this->render('event/detail.html.twig', [
            'details' => $detail]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @Route("/add",name="add")
     */

    public function add(Request $request)
    {
        $event = new Event();
        $form=$this->createForm(EventType::class, $event);
        $form->add('add', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('showEvent');
        }

        return $this->render('event/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
/**
 * @Route("edit/{id}",name="edit")
 */
  function edit($id,EventRepository $repository,Request $request)
  {
      $event=$repository->find($id);
      $form=$this->createForm(EventType::class,$event);
      $form->add('edit',SubmitType::class);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
          $em=$this->getDoctrine()->getManager();
          $em->flush();
          return $this->redirectToRoute('showEvent');
      }
      return $this->render('event/edit.html.twig',
          ['f'=>$form->createView()]);
  }

}