<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/produits')]
class ProduitsController extends AbstractController
{
    #[Route('/', name: 'app_produits_index', methods: ['GET'])]
    public function index(ProduitsRepository $produitsRepository, Request $request, CategoriesRepository $categoriesRepository): Response
    {
        $nom = $request->query->get('nom');
        $categoriesId = $request->query->get('categories');
    if ($categoriesId && $nom) {
        $categories = $categoriesRepository->find($categoriesId);
        $produits = $produitsRepository->findByCategoriesAndName($categories, $nom);
    } elseif ($categoriesId) {
        $categories = $categoriesRepository->find($categoriesId);
        $produits = $produitsRepository->findByCategories($categories);
    } elseif ($nom) {
        $produits = $produitsRepository->findByName($nom);
    } else {
        $produits = $produitsRepository->findAll();
    }
        $categories = $categoriesRepository->findAll();
        return $this->render('produits/index.html.twig', [
            'produits' => $produits,
            'categories' => $categories,
        ]);
    }

}
