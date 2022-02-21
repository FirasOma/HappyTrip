<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 *
 * @Route ("/payment")
 */
class PaymentController extends AbstractController
{
    /**
     * @Route("/checkout/{total}", name="pay")
     */
    public function indexPayment($total)
    {
      //  $total_to_pay = $request->get('total');
        return $this->render('payment/payment-reservation.html.twig',['total'=>$total]);
    }


    /**
     * @Route("/success", name="success")
     */
    public function success()
    {

        return $this->render('payment/success.html.twig');
    }


    /**
     * @Route("/error", name="error")
     */
    public function error()
    {

        return $this->render('payment/error.html.twig');
    }


    /**
     * @Route("/create-checkout-session", name="checkout")
     */
    public function checkout(Request $request)
    {
//        if ($request->isMethod('POST'))
//        {
            $total = $request->get('total');

            \Stripe\Stripe::setApiKey('sk_test_51IaP1yJTzGa3VAzuy0e6MVvYEQYxM9rFSz0fARdgn5h9ZnWewb5fESlDasyeyZjPj7j54EQ969zFgu92f7mQrpk900LypQQDtj');
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Hotel Reservation',
                        ],
                        'unit_amount' => "3000"
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $this->generateUrl('success',[],UrlGeneratorInterface::ABSOLUTE_URL),
                'cancel_url' => $this->generateUrl('error',[],UrlGeneratorInterface::ABSOLUTE_URL),
            ]);

      ///  $price = $request->get('total')



        return new JsonResponse([ 'id' => $session->id ]);

    }
}
