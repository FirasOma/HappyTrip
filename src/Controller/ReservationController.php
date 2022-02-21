<?php

namespace App\Controller;


use App\Entity\Reservation;
use App\Form\ReservationFormType;
use App\Repository\HotelRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 *
 * @Route ("/reservationHotel   ")
 */
class ReservationController extends AbstractController
{


    /**
     * @return Response
     * @Route("/{idreservation}",name="reservationHotel")
     */

    public function createReservation($idreservation,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reservation=$em->getRepository(Reservation::class)->find($idreservation);

        return $this->render('reservation/create-reservation.html.twig',['res'=>$reservation]);
    }


    /**
     * @param $id
     * @return Response
     * @Route("/confirm/{id}/{total}",name="confirm")
     */
    public function confirm($id,$total)
    {
        $user = $this->getUser();
        $am = $this->getDoctrine()->getManager();
        $res = $am->getRepository(Reservation::class)->find($id);
        $am->flush();
        return $this->redirectToRoute('pay',['total'=>$total]);
    }

    /**
     * @param $id
     * @return Response
     * @Route("/reject/{id}",name="reject")
     */
    public function rejectAction($id)
    {

        $sn = $this->getDoctrine()->getManager();
        $res = $sn->getRepository(Reservation::class) ->find($id);
        $sn->remove($res);
        $sn->flush();
        return $this->redirectToRoute('afficheHotel', ['id' => $res->getHotelReservation()->getId()]);

    }

}
