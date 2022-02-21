<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\TemporalUser;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use http\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{

  public function generateRandomString($length = 6, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
  {
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(\Swift_Mailer $mailer, Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator): Response
    {
        $user = new User();
        $tempuser = new TemporalUser();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $entityManagerTemp = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
          try {
            $random =''.$this->generateRandomString();
            $tempuser->setEmail($user->getEmail());
            $tempuser->setCodeGenerated($random);
            $tempuser->setUsername($user->getUsername());

            $entityManagerTemp->persist($tempuser);
            $entityManagerTemp->flush();
            $id = $tempuser->getId();
          $message = (new \Swift_Message('Verify your account'))
        ->setFrom('amorfiras32@gmail.com')
        ->setTo($user->getEmail())
        ->setBody(
            'Thanks for registering to our website !
            <br>Please <a href = "http://localhost:8000/verify/'.$id.'">
            verify your account</a> by entering this code:<br>'.$random,
            'text/html'
        );
            $mailer->send($message);

          } catch (Exception $e) {
            dd ('Unable to send email');
            dd ($user->getEmail());
          }
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(array('ROLE_INTERNAUTE'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
            return $this->redirectToRoute('app_verify', array('id' => $tempuser->getId()));
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
