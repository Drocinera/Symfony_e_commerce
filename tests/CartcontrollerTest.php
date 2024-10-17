<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testAddToCart()
    {
        $client = static::createClient();
        
        // Simule une requête POST pour ajouter un produit au panier
        $client->request('POST', '/cart/add/1', ['size' => 'M']);

        // Vérifie que la réponse est une redirection vers la vue du panier
        $this->assertResponseRedirects('/cart');

        // Simule l'accès à la vue du panier
        $client->followRedirect();
        $this->assertSelectorTextContains('.cart-item', 'Produit ajouté');
    }

    public function testCheckout()
    {
        $client = static::createClient();

        // Simule l'ajout d'un produit au panier
        $client->request('POST', '/cart/add/1', ['size' => 'M']);

        // Simule une requête POST pour le checkout
        $client->request('POST', '/cart/checkout');

        // Vérifie que la redirection vers Stripe fonctionne bien
        $this->assertResponseRedirects('https://checkout.stripe.com/');
    }
}
