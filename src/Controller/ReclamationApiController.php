<?php

namespace App\Controller;
use App\Entity\Reclamation;
use App\Entity\User;

use App\Repository\ReclamationRepository;
use App\Repository\UserRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
     * @Route("/reclamation/api", name="reclamation_api")
     */
class ReclamationApiController extends AbstractController
{

    /**
     * @Route("/getAll", name="apiGetAll", methods={"GET"})
     */
    public function ApiGetAllReclamation(ReclamationRepository $reclamation): Response
    {
        $reclamations = $reclamation->findAll();

        // Tip : Inject SerializerInterface $serializer in the controller method
// and avoid these 3 lines of instanciation/configuration
$encoders = [new JsonEncoder()]; // If no need for XmlEncoder
$normalizers = [new ObjectNormalizer()];
$serializer = new Serializer($normalizers, $encoders);

// Serialize your object in Json
$jsonObject = $serializer->serialize($reclamations, 'json', [
    'circular_reference_handler' => function ($object) {
        return $object->getId();
    }
]);

// For instance, return a Response with encoded Json
return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }



    /**
     * @Route("/addRec", name="addRec", methods={"POST"})
     */


    public function newReclamationAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();


        $reclamation = new Reclamation();
      
        
        $reclamation->setSubject($request->get('subject'));
        $reclamation->setMessage($request->get('message'));
        $user = $em
            ->getRepository(User::class)
            ->find($request->get('user'));
       
        $reclamation->setUser($user);
        $reclamation->setStarsNumber($request->get('stars'));
       
        $em->persist($reclamation);
        $em->flush();
        

         // Tip : Inject SerializerInterface $serializer in the controller method
// and avoid these 3 lines of instanciation/configuration
$encoders = [new JsonEncoder()]; // If no need for XmlEncoder
$normalizers = [new ObjectNormalizer()];
$serializer = new Serializer($normalizers, $encoders);

// Serialize your object in Json
$jsonObject = $serializer->serialize($reclamation, 'json', [
    'circular_reference_handler' => function ($object) {
        return $object->getId();
    }
]);

// For instance, return a Response with encoded Json
return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);
    }
}
