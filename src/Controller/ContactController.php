<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactFormType;
use App\Entity\Contact;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $util=new Contact();
        $form= $this->createForm(ContactFormType::class, $util);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()){
            $contact = new Contact();
            $form = $this->createForm(ContactFormType::class, $contact);
            $form->handleRequest($request);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            $contact=$form->getData();
            $m=$util->getMail();
            

            //le mail
            $message= (new \Swift_Message('Nouveau Contact'))
             // on attend le remplir de message 
             ->setFrom('miledmld10@gmail.com')

             //on attribut le destinataire
             ->setTo($m)

             //on crée le message
             ->setBody(
                 $this->renderView(
                     'emails/contact.html.twig',compact('contact')
                 ),
                 'text/html'
             
                );
                //on envoie le message
                $mailer->send($message);

                return $this->redirectToRoute('contact');
             
        }
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
