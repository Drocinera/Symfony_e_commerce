<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {
        return $this->render('cart/cart.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    public function addToCart(Request $request, int $id): Response
{
    $selectedSize = $request->request->get('size');

}
}
