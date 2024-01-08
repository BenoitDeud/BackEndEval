<?php

namespace App\Controller;

use App\Entity\Montres;
use App\Form\MontresType;
use App\Repository\MontresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/montres')]
class MontresController extends AbstractController
{
    #[Route('/', name: 'app_montres_index', methods: ['GET'])]
    public function index(MontresRepository $montresRepository): Response
    {
        return $this->render('montres/index.html.twig', [
            'montres' => $montresRepository->findAll(),
        ]);
    }
}
