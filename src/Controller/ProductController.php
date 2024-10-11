<?php

namespace App\Controller;

use App\Repository\SweatshirtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'product_show')]
    public function show(int $id, SweatshirtRepository $sweatshirtRepository, Request $request): Response
    {
        $sweatshirt = $sweatshirtRepository->find($id);

        if (!$sweatshirt) {
            throw $this->createNotFoundException('Le produit n\'existe pas');
        }

        $cart = $request->getSession()->get('cart', []);

        return $this->render('product/show.html.twig', [
            'sweatshirt' => $sweatshirt,
            'cart' => $cart,
        ]);
    }
}
