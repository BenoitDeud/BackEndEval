<?php

namespace App\Controller;

use App\Entity\Telephones;
use App\Form\TelephonesType;
use App\Repository\TelephonesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/telephones')]
class TelephonesController extends AbstractController
{
    #[Route('/', name: 'app_telephones_index', methods: ['GET'])]
    public function index(TelephonesRepository $telephonesRepository): Response
    {
        return $this->render('telephones/index.html.twig', [
            'telephones' => $telephonesRepository->findAll(),
        ]);
    }
}
