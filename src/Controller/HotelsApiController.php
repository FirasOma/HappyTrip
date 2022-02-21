<?php

namespace App\Controller;


use App\Entity\Hotel;

use App\Repository\HotelRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 *
 * @Route ("/hotels")
 */
class HotelsApiController extends AbstractController
{

    /**
     * @Route("/getallhotels",name="list_hotels")
     */
    public function getAllHotels(HotelRepository  $hoterepo,SerializerInterface  $serialize)
    {

        $hotels = $hoterepo->findAll();

        $json = $serialize->serialize($hotels, 'json', ['groups' => 'Hotel']);


        return new Response($json, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @Route("/addHotel",name="ajouterHotel")
     */
    public function AddHotel(Request $request,SerializerInterface $serializerinterface)
    {
        $em = $this->getDoctrine()->getManager();
        $content = $request->getContent();
        $data = $serializerinterface->deserialize($content,Hotel::class,'json');
        $em->persist($data);
        $em->flush();
        return new Response('Hotel added successfully');
    }


    /**
     * @Route("/updateHotel/{id}", name="updateHotel", methods={"PUT"})
     */
    public function update(Request $request, SerializerInterface $serializer ,ValidatorInterface $validator,$id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $hotelToupdate = $entityManager->getRepository(Hotel::class)->find($id);

        $data = json_decode($request->getContent());
        foreach ($data as $key => $value){
            if($key && !empty($value)) {
                $name = ucfirst($key);
                $setter = 'set'.$name;
                $hotelToupdate->$setter($value);
            }
        }
        $errors = $validator->validate($hotelToupdate);
        if(count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        $entityManager->flush();
        $data = [
            'status' => 200,
            'message' => 'hotel a bien été mis à jour'
        ];
        return new JsonResponse($data);
    }


    /**
     * @Route("/detailshotels/{id}", name="show_phone", methods={"GET"})
     */
    public function showById($id, HotelRepository $hotelRepository, SerializerInterface $serializer)
    {
        $phone = $hotelRepository->find($id);
        $data = $serializer->serialize($phone, 'json', [
            'groups' => ['Hotel']
        ]);



        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }


    /**
     * @Route("/delete/{id}", name="delete_hotel", methods={"DELETE"})
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();

        $hotel = $em->getRepository(Hotel::class)->find($id);

        $em->remove($hotel);
        $em->flush();

        $data = [
            'status' => 200,
            'message' => 'hotel deleted'
        ];
        return new JsonResponse($data);

    }








}