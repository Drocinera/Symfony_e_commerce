<?php

namespace App\Tests\Service;

use App\Service\StripeService;
use PHPUnit\Framework\TestCase;

class StripeServiceTest extends TestCase
{
    public function testCreateCheckoutSession()
    {
        $stripeService = new StripeService('sk_test_xxxxxxxxxxxxxxxxx');
        
        $items = [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'Sweatshirt',
                ],
                'unit_amount' => 2000, // en centimes
            ],
            'quantity' => 1,
        ]];

        $session = $stripeService->createCheckoutSession($items, 'https://success-url', 'https://cancel-url');
        
        $this->assertNotEmpty($session->id);
    }
}
