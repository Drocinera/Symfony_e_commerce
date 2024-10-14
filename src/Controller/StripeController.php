<?php

namespace App\Controller;

use App\Service\StripeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    #[Route('/create-checkout-session', name: 'create_checkout_session', methods: ['POST'])]
    public function createCheckoutSession(StripeService $stripeService)
    {
        $items = [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'T-shirt',
                ],
                'unit_amount' => 2000, // en centimes
            ],
            'quantity' => 1,
        ]];

        $checkoutSession = $stripeService->createCheckoutSession(
            $items, 
            'https://votre-site.com/success', 
            'https://votre-site.com/cancel'
        );

        return new JsonResponse(['id' => $checkoutSession->id]);
    }
}
