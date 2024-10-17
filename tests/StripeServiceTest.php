<?php

namespace App\Tests\Service;

use App\Service\StripeService;
use PHPUnit\Framework\TestCase;

class StripeServiceTest extends TestCase
{

    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testCreateCheckoutSession()
    {
        $stripeService = new StripeService('sk_test_51Q9nhjRqck3hAfCRZnySZw6kz1kFUc5JdOC8UjQV1ej7Fgd3P83icPGinEVbj2oh1m55vUWoAW68JsOrnvhzPwKU00yOgNDxqB');
        
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
