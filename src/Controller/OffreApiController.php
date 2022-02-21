<?php

namespace App\Controller;



use App\Entity\Offer;

use App\Repository\OfferRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


    /**
     * @Route("/offre/api", name="offre_api")
     */
class OffreApiController extends AbstractController
{

    /**
     * @Route("/getAll",name="getAll")
     */
    public function getAllHotels(OfferRepository  $ofrRepo,SerializerInterface  $serialize)
    {

        $offres = $ofrRepo->findAll();

        $json = $serialize->serialize($offres, 'json', ['groups' => 'Offre']);


        return new Response($json, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
