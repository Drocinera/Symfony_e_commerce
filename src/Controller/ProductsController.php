<?php

namespace App\Controller;


use App\Entity\Sweatshirt;
use App\Repository\SweatshirtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(SweatshirtRepository $sweatshirtRepository, Request $request): Response
    {

        $priceRange = $request->query->get('priceRange', 'all');

        $sweatshirts = $this->getSweatshirtsByPriceRange($sweatshirtRepository, $priceRange);

        return $this->render('products/products.html.twig', [
            'sweatshirts' => $sweatshirts,
            'currentPriceRange' => $priceRange,
        ]);
    }

    private function getSweatshirtsByPriceRange(SweatshirtRepository $sweatshirtRepository, string $priceRange)
    {
        switch ($priceRange) {
            case '10-29':
                return $sweatshirtRepository->findByPriceRange(10, 29);
            case '29-35':
                return $sweatshirtRepository->findByPriceRange(29, 35);
            case '35-50':
                return $sweatshirtRepository->findByPriceRange(35, 50);
            default:
                return $sweatshirtRepository->findAll();
        }
    }
}