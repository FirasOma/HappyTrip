<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class GererDestinationsController extends AbstractController {



    /**
     * @Route  ("/gererDestination" , name="gererDestination")
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index():Response
    {
        return $this->render('pages/GererDestination.html.twig');
    }

}