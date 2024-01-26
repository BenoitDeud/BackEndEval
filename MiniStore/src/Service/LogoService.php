<?php
// src/Service/LogoService.php

namespace App\Service;

use App\Repository\LogoRepository;

class LogoService
{
    private $logoRepository;

    public function __construct(LogoRepository $logoRepository)
    {
        $this->logoRepository = $logoRepository;
    }

    public function getLogo()
    {
        return $this->logoRepository->find(1); // Remplacez 1 par l'ID du logo que vous voulez récupérer
    }
}
?>