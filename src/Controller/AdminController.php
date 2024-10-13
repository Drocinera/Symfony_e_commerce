<?php

namespace App\Controller;

use App\Entity\Sweatshirt;
use App\Form\SweatshirtType;
use App\Repository\SweatshirtRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin', name: 'admin_index')]
    public function index(SweatshirtRepository $sweatshirtRepository, Request $request): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Vous n\'avez pas accès à cette page.');
        }

        $sweatshirt = new Sweatshirt();
        $addForm = $this->createForm(SweatshirtType::class, $sweatshirt);

        $addForm->handleRequest($request);
        if ($addForm->isSubmitted() && $addForm->isValid()) {

            foreach ($sweatshirt->getSizes() as $size) {
                $size->setSweatshirt($sweatshirt);  // Relier chaque taille au sweatshirt
            }

            $this->entityManager->persist($sweatshirt);
            $this->entityManager->flush();

            $this->addFlash('success', 'Produit ajouté avec succès.');

            return $this->redirectToRoute('admin_index');
        }

        $sweatshirts = $sweatshirtRepository->findAll();

        return $this->render('admin/admin.html.twig', [
            'addForm' => $addForm->createView(),
            'sweatshirts' => $sweatshirts,
        ]);
    }

    #[Route('/admin/edit/{id}', name: 'admin_edit')]
    public function edit(Request $request, Sweatshirt $sweatshirt): Response
    {
        $editForm = $this->createForm(SweatshirtType::class, $sweatshirt);

        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->entityManager->flush();

            $this->addFlash('success', 'Produit modifié avec succès.');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/edit.html.twig', [
            'editForm' => $editForm->createView(),
            'sweatshirt' => $sweatshirt,
        ]);
    }

    #[Route('/admin/delete/{id}', name: 'admin_delete', methods: ['POST'])]
    public function delete(int $id, SweatshirtRepository $sweatshirtRepository): Response
    {
        $sweatshirt = $sweatshirtRepository->find($id);

        if (!$sweatshirt) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        $this->entityManager->remove($sweatshirt);
        $this->entityManager->flush();

        $this->addFlash('success', 'Produit supprimé avec succès.');

        return $this->redirectToRoute('admin_index');
    }
}
