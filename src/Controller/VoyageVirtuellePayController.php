<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class VoyageVirtuellePayController extends AbstractController
{
    /**
     * @Route ("/VoyageVirtuellePay", name="VoyageVirtuellePay")
     */
    public function index(): Response
    {
        return $this->render('pages/VoyageVirtuellePay.html.twig' , [
            'controller_name' => 'VoyageVirtuellePay',
        ]);
    } /**
     * @Route ("/VoyageVirtuellePaySuccess", name="VoyageVirtuellePaySuccess")
     */
    public function VoyageVirtuellePaySuccess(): Response
    {
        return $this->render('pages/VoyageVirtuellePaySuccess.html.twig' , [
            'controller_name' => 'VoyageVirtuellePay',
        ]);
    } /**
     * @Route ("/VoyageVirtuellePayError", name="VoyageVirtuellePayError")
     */
    public function VoyageVirtuellePayError(): Response
    {
        return $this->render('pages/VoyageVirtuellePayError.html.twig' , [
            'controller_name' => 'VoyageVirtuellePay',
        ]);
    }
    /**
     * @Route ("/create-checkout-session", name="checkoutVoyage")
     */
    public function checkout(): Response
    {

        \Stripe\Stripe::setApiKey('sk_test_51Ia0XkBJAePb7PXkbBQ06F54pwOjOxXQ41FgUrZyRsQTUVBuY4MCa0vKqMSPeczUGcdDivwSA5iiantH7OuGbpG500GTNbCoBH');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('VoyageVirtuellePaySuccess', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('VoyageVirtuellePayError', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        return new JsonResponse([ 'id' => $session->id ]);
    }
}