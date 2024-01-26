<?php
namespace App\Service;

use App\Repository\NavbarRepository;

class NavbarService
{
    private $navbarRepository;

    public function __construct(NavbarRepository $navbarRepository)
    {
        $this->navbarRepository = $navbarRepository;
    }

    public function getNavItems()
    {
        return $this->navbarRepository->findAll();
    }
}
?>