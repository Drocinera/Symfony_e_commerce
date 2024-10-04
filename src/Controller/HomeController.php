<?php

// src/Controller/HomeController.php

namespace App\Controller;

use App\Repository\SweatshirtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(SweatshirtRepository $sweatshirtRepository): Response
    {
        // Récupérer les produits mis en avant (highlight = true)
        $highlightedSweatshirts = $sweatshirtRepository->findBy(['Highlight' => true]);

        return $this->render('home/home.html.twig', [
            'highlightedSweatshirts' => $highlightedSweatshirts,
        ]);
    }
}
