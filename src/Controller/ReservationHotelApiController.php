<?php

namespace App\Controller;


use App\Entity\Reservation;
use App\Entity\Hotel;
use App\Form\ReservationFormType;
use App\Repository\HotelRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Entity\User;
use App\Repository\UserRepository;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;



/**
 *
 * @Route ("/ReserHotel")
 */
class ReservationHotelApiController extends AbstractController
{


    /**
     * @Route("/mobile/add",name="reservationHoteladd", methods={"POST"})
     */

    public function newReservation(Request $request)
    {
         $em = $this->getDoctrine()->getManager();
        $reservation = new Reservation();
        $reservation->setNumberOfNights($request->get('nights'));
        $reservation->setNumberOfrooms($request->get('rooms'));
        $reservation->setNumberOfAdults($request->get('test'));
        $reservation->setNumberOfChilds($request->get('childs'));
        $reservation->setRoomType($request->get('type'));
        $reservation->setTotal($request->get('total'));
        $hotel = $em
            ->getRepository(Hotel::class)
            ->find($request->get('hotel'));
        $reservation->setHotelReservation($hotel);
        $ds=strtotime($request->get('start'));
        $de=strtotime($request->get('end'));
        $reservation->setStartDate(new \DateTime($request->get('start')));
        $reservation->setEndDate(new \DateTime($request->get('end')));
        $user = $em
            ->getRepository(User::class)
            ->find($request->get('user'));
        $reservation->setUser($user);
        $em->persist($reservation);
        $em->flush();
         // Tip : Inject SerializerInterface $serializer in the controller method
// and avoid these 3 lines of instanciation/configuration
$encoders = [new JsonEncoder()]; // If no need for XmlEncoder
$normalizers = [new ObjectNormalizer()];
$serializer = new Serializer($normalizers, $encoders);

// Serialize your object in Json
$jsonObject = $serializer->serialize($reservation, 'json', [
    'circular_reference_handler' => function ($object) {
        return $object->getId();
    }
]);

// For instance, return a Response with encoded Json
return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
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
