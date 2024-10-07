<?php

namespace App\Controller;

use App\Entity\Sweatshirt;
use App\Repository\SweatshirtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'product_show')]
    public function show(int $id, SweatshirtRepository $sweatshirtRepository): Response
{

    $sweatshirt = $sweatshirtRepository->find($id);


    if (!$sweatshirt) {
        throw $this->createNotFoundException('Le produit n\'existe pas');
    }


    return $this->render('product/show.html.twig', [
        'sweatshirt' => $sweatshirt,
    ]);
}
}
