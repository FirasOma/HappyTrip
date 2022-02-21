<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Form\CommentsType;
use App\Form\HotelType;
use App\Form\ReservationFormType;
use App\Repository\HotelRepository;
//use http\Env\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 *
 * @Route ("/hotels")
 */
class HotelController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var Environment
     * HotelController constructor.
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    /**
     * @param HotelRepository $repo
     * @return Response
     * @Route("/book/{idhotel}",name="book-hotel")
     */
    public function bookHotel(Request $request,$idhotel,HotelRepository $repo)
    {

        $hotel = $repo->find($idhotel);

        $reservation = new Reservation();

        $form = $this->createForm(ReservationFormType::class,$reservation);

        $form->handleRequest($request);

//        $form->add('Book',SubmitType::class);

       // $user = $this->container->get('security.token_storage')->getToken()->getUser();

        // $user = $this->getUser();


        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $NbRoomChosen = $form->get('numberOfrooms')->getData();
            $roomtype = $form->get('roomType')->getData();
            $numberofnights = $form->get('numberOfNights')->getData();

            if ($NbRoomChosen>$hotel->getAvailableRooms())
            {
                 //$this->addFlash('alert', 'there is no available rooms !!');
                return $this->redirectToRoute('afficheHotel',['idhotel'=>$hotel->getId()]);
            }
            else
            {

                if ( $roomtype == 'half pension' and $numberofnights < 15)
                {

                    $reservation->setTotal(100 * $numberofnights);

                }
                if ($roomtype =='full pension' and $numberofnights < 15) {

                    $reservation->setTotal(200 * $numberofnights);
                }

                if ($roomtype == 'All Inclusive' and $numberofnights < 15) {

                    $reservation->setTotal(300 * $numberofnights);

                }


                if ($roomtype=='All inclusive Soft Drink' and $numberofnights < 15) {
                    $reservation->setTotal(400 * $numberofnights);
                }


                $reservation->setNumberOfrooms($NbRoomChosen);

                $reservation->setUser($this->getUser());
                $reservation->setHotelReservation($hotel);
                $em->persist($reservation);
                $em->flush();

                return $this->redirectToRoute('reservationHotel',['idreservation'=>$reservation->getId()]);
            }

            //return $this->redirectToRoute('reservation', array('id' => $reservation->getId()));

        }


        return $this->render('reservation/form-reservation.html.twig',
            ['form'=> $form->createView()]);
    }



    /**
     * @param HotelRepository $repository
     * @return Response
     * @Route("/all",name="afficheHotel")
     */
    public function Affiche(Request $request,PaginatorInterface $paginator,HotelRepository $hotelrepo)
    {
        $hotelss = new Hotel();
        $hotel = new Hotel();
        $q = $request->get('q', null);

        $em = $this->getDoctrine()->getManager();


        if (empty($q))
        {
            $hotel= $em->getRepository(Hotel::class)->findAll();
            $hotel = $paginator->paginate(
                $hotel,
                $request->query->getInt('page',1),
                3
            );
        }
        else
        {
            $hotelss = $hotelrepo->rechercherParNom($q);
            $hotel = $paginator->paginate(
                $hotelss,
                $request->query->getInt('page',1),
                3
            );
        }


        return $this->render('hotel/Affiche.html.twig' , ['hotels'=>$hotel,'hotelssearch'=>$hotelss,'search'=>$q]);
    }

//    /**
//     * @param HotelRepository $repository
//     * @return Response
//     * @Route("/search",name="searchHotel")
//     */
//    public function Search(Request $request,PaginatorInterface $paginator,HotelRepository $hotelrepo)
//    {
//
//        $q = $request->get('q', null);
//
//        $em = $this->getDoctrine()->getManager();
//
//
//        if (empty($q))
//        {
//            $hotel= $em->getRepository(Hotel::class)->findAll();
//            $hotel = $paginator->paginate(
//                $hotel,
//                $request->query->getInt('page',1),
//                3
//            );
//        }
//        else
//        {
//            $hotels = $hotelrepo->rechercherParNom($q);
//            $hotels = $paginator->paginate(
//                $hotels,
//                $request->query->getInt('page',1),
//                3
//            );
//        }
//
//
//        return $this->render('hotel/Affiche.html.twig' , ['hotels'=>$hotel,'hotelssearch'=>$hotels,'search'=>$q]);
//    }


//    /**
//     * @param Request $request
//     * @Route("/search",name="ajax_search")
//     */
//    public function searchAction(Request $request,HotelRepository $hotelrepo)
//    {
//        $hotel = new Hotel();
//        $em = $this->getDoctrine()->getManager();
//        $requestString = $request->get('q');
//        $hotel =  $hotelrepo->findHotelsByName($requestString);
//        if(!$hotel)
//        {
//            $result['hotel']['error'] = "Hotel Not found :( ";
//        } else {
//            $result['hotel'] = $this->getHotels($hotel);
//        }
//        return new Response(json_encode($result));
//    }
//
//    public function getHotels($hotel){
//        foreach ($hotel as $hotel)
//        {
//            $realHotels[$hotel->getId()] = [$hotel->getImage(),$hotel->getName(),$hotel->getStarsNumber()];
//
//        }
//        return $realHotels;
//    }



    /**
     * @param HotelRepository $repository
     * @return Response
     * @Route("/details/{id}",name="details_hotels")
     */

        public function details(Request $request, $id ,HotelRepository $repository)
        {
            $details_hotels = $repository->find($id);
            $em = $this->getDoctrine()->getManager();
            $comment = new Comments();
            $form = $this->createForm(CommentsType::class, $comment);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
              $comment->setDateCreation(new \DateTime('now'));
              $hotel = $repository->find($id);
              $comment->setHotel($hotel);
              $comment->setUser($this->getUser());
              $em->persist($comment);
              $em->flush();
              return $this->redirectToRoute('details_hotels', array('id' => $id));
            }
            $allComments = $em->getRepository(Comments::class)->findAll();
            $commentsH = $em->getRepository(Comments::class)->findBy(['id' => $id]);

            $size = 0;
            $hotel = $em->getRepository(Hotel::class)->find($id);

            return $this->render('hotel/Details.html.twig',[
                'details'=>$details_hotels,
                'allComments'=>$allComments,
                'hotel'=>$hotel,
                'comment'=>$comment,
                'size'=>$size,
                'form'=>$form->createView()
            ]);

        }



//    /**
//     * @Route ("/Supp/{id}",name="d")
//     * @param Request $request
//     * @param Hotel $hotel
//     */
//    public function Delete(Request $request, Hotel $hotel)
//    {
//        $form = $this->createDeleteForm($hotel);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($hotel);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('AfficheHotel');
//    }
    //function Delete($id,HotelRepository $repository){
     //   $Hotel=$repository->find($id);
     //   $em=$this->getDoctrine()->getManager();
     //   $em->remove($Hotel);
     //   $em->flush();
     //   return $this->redirectToRoute('AfficheHotel');

   // }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/Add",name="ADD")
     */
    function Add(Request $request){
        $Hotel=new Hotel();
        $form=$this->createForm(HotelType::class,$Hotel);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
       //
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($Hotel);
            $em->flush();
            return $this->redirectToRoute('AfficheHotel');
        }
        return $this->render('hotel/Add.html.twig',[
            'form'=>$form->createView()
        ]) ;
    }

    /**
     * @Route ("Modifier/{id}",name="modifier")
     */
    function Modifier(HotelRepository $repository,$id,Request $request)
    {
        $Hotel=$repository->find($id);
        $form=$this->createForm(HotelType::class,$Hotel);
        $form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficheHotel');
        }
        return $this->render('hotel/Modifier.html.twig',
        ['f'=>$form->createView()]);

    }

}
