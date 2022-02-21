<?php


namespace App\Controller;


use App\Entity\User;
use App\Entity\TemporalUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class VerifyController extends AbstractController {

//
    /**
    //     * @var Security
    //     */
//
//    private $security;

    /**
     * @Route("/verify/{id}", name="app_verify")
     */

    public function verify(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $tempuser= $em->getRepository(TemporalUser::class)->find($id);

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=> $tempuser->getEmail()]);

        //$user = $this->container->get('security.token_storage')->getToken()->getUser();

        if ($request->isMethod('POST')) {
            $verifyCode = $request->get('securityCode');
            if ($user->getUsername() == $tempuser->getUsername()) {
                if($verifyCode == $tempuser->getCodeGenerated()) {
                    $user->setCodeGenerated($tempuser->getCodeGenerated());
                    $em->persist($user);
                    $em->flush();
                    return $this->redirectToRoute('home');
                }
           }
        }
        return $this->render('verification/verify.html.twig');
    }
}
