<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AjouterDestinationControler extends AbstractController {



    /**
     * @Route  ("/ajouterUneDestination" , name="ajouterUneDestination")
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index():Response
    {
        return $this->render('pages/AjouterDestination.htm.twig');
    }

}