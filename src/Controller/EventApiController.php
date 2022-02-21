<?php

namespace App\Controller;



use App\Entity\Event;

use App\Repository\EventRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
     * @Route("/event/api", name="event_api")
     */

class EventApiController extends AbstractController
{
    
   /**
     * @Route("/getAll",name="getAll")
     */
    public function getAllHotels(EventRepository  $hoterepo,SerializerInterface  $serialize)
    {

        $hotels = $hoterepo->findAll();

        $json = $serialize->serialize($hotels, 'json', ['groups' => 'Event']);


        return new Response($json, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
