<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @Route ("/api")
 */
class UserApiController extends AbstractController

{

    /**
     * @Route("/login/{email}/{password}",name="api_login")
     */
    public function  loginAction( $email,$password )
    {

        $em1 = $this->getDoctrine()->getManager();
        $user=$em1->getRepository(User::class)->findOneBy(["email"=>$email]);

        $test=array();
        $u=new User();
        $us=array();

        if ($user==null)
        {

            $u->setEmail('null');
            $u->setPassword('null');
            $us=[$u];



        }

        else if($user->getPassword() != $password)
        {

            $u->setEmail('null');
            $u->setPassword('null');
            $u->setUsername('null');

           // array_push($test,$us);
        }
        else
        {

            $u=$user;
            $us=[$u];


            array_push($test,$us);
        }

        // $serializer = new Serializer([new ObjectNormalizer()]);
        // $formatted = $serializer->normalize($us);
        // return new JsonResponse($formatted);

        
         // Tip : Inject SerializerInterface $serializer in the controller method
// and avoid these 3 lines of instanciation/configuration
$encoders = [new JsonEncoder()]; // If no need for XmlEncoder
$normalizers = [new ObjectNormalizer()];
$serializer = new Serializer($normalizers, $encoders);

// Serialize your object in Json
$jsonObject = $serializer->serialize($us, 'json', [
    'circular_reference_handler' => function ($object) {
        return $object->getId();
    }
]);

// For instance, return a Response with encoded Json
return new Response($jsonObject, 200, ['Content-Type' => 'application/json']);

    }


    /**
     * @Route("/register/{username}/{email}/{password}/{repeatedpassword}",name="api_register",methods={"POST"})
     */
    public function registerAction($username,$email,$password,$repeatedpassword,UserPasswordEncoderInterface $encoder)
    {
        $user= new User();


        if ( $password == $repeatedpassword)
        {

            $user->setUsername($username);
            $user->setEmail($email);

            $encoder = $encoder->encodePassword($user,$password);
            $user->setPassword(
              $encoder
            );
            $user->setPassword($password);
            $user->setRoles(['ROLE_INTERNAUTE']);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


        }

        else
        {
            $user->setUsername(null);
            $user->setEmail(null);
            $user->setPassword(null);

        }

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);

    }

    /**
     * @Route("/Profile/edit/{id}/{username}/{email}/{password}/{repeatedpassword}",name="edit_profile")
     */

    public function editAction($id,$username,$email,$password,$repeatedpassword)
    {
        $u = new User();

        $em = $this->getDoctrine()->getManager();
        $userToEdit = $em->getRepository(User::class)->findOneBy(["id"=>$id]);

        if ($password == $repeatedpassword)
        {
            $u = $userToEdit;
            $u->setUsername($username);
            $u->setEmail($email);
            $u->setPassword($password);

            $em->flush();
        }
        else
        {
            $u = [$userToEdit];
        }

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($u);
        return new JsonResponse($formatted);

    }

    /**
    /* @Route("/Profile/find",name="find_user_by_id")
     */
    public function findUserByidAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);

    }


}