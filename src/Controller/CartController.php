<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SweatshirtRepository;

class CartController extends AbstractController
{
    private $sweatshirtRepository;

    public function __construct(SweatshirtRepository $sweatshirtRepository)
    {
        $this->sweatshirtRepository = $sweatshirtRepository;
    }

    #[Route('/cart/add/{id}', name: 'app_cart', methods: ['POST'])]
    public function addToCart(Request $request, int $id, SessionInterface $session): Response
    {
        $sweatshirt = $this->sweatshirtRepository->find($id);

        if (!$sweatshirt) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        $size = $request->request->get('size');


        $cart = $session->get('cart', []);

        $cart[] = [
            'sweatshirt_id' => $sweatshirt->getId(),
            'size' => $size,
        ];

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart_view');
    }

    #[Route('/cart', name: 'app_cart_view')]
    public function cartView(SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        $cartItems = [];
        $totalPrice = 0;

        foreach ($cart as $item) {
            $sweatshirt = $this->sweatshirtRepository->find($item['sweatshirt_id']);
            if ($sweatshirt) {
                $cartItems[] = [
                    'sweatshirt' => $sweatshirt,
                    'size' => $item['size'],
                ];
                $totalPrice += $sweatshirt->getPrice();
            }
        }

        return $this->render('cart/cart.html.twig', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    #[Route('/cart/remove/{id}/{size}', name: 'remove_from_cart', methods: ['POST'])]
    public function removeFromCart(int $id, string $size, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        // Rechercher et supprimer l'article du panier
        foreach ($cart as $key => $item) {
            if ($item['sweatshirt_id'] == $id && $item['size'] == $size) {
                unset($cart[$key]);
                break;
            }
        }

        // Réindexer le tableau après suppression de l'article
        $cart = array_values($cart);

        $session->set('cart', $cart);
        
        return $this->redirectToRoute('app_cart_view');
    }
}
