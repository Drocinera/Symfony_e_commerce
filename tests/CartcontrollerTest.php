<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartControllerTest extends WebTestCase
{
    public function testAddToCart()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/cart/add/1', ['size' => 'M']);

        $this->assertResponseRedirects('/cart');
        $client->followRedirect();

        $this->assertSelectorTextContains('h1', 'Mon Panier');
    }

    public function testCheckout()
    {
        $client = static::createClient();
        $client->request('POST', '/cart/checkout');

        $this->assertResponseRedirects(); // Redirigé vers Stripe
    }
}
