<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ModifierDestinationController{

    /**
     * @var Environment
     */
    private $twig;
    public function __construct( Environment $twig)
    {
        $this ->twig = $twig;
    }

    /**
     * @Route  ("/modfierUneDestination" , name="modfierUneDestination")
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index():Response
    {
        return new Response($this->twig->render('pages/ModifierDestination.html.twig'));
    }

}