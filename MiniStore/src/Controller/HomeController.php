<?php

namespace App\Controller;

use App\Repository\LogoRepository;
use App\Repository\NavbarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    public function getLogo(LogoRepository $logoRepository)
    {
        return $logoRepository->find(1);
    }

    public function getLink(NavbarRepository $navbarRepository)
    {
        return $navbarRepository->findAll();
    }

}