<?php

namespace App\Controller;


use App\Form\LivraisonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class LivraisonController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/livraison', name: 'app_livraison')]
    
    public function edit2(Request $request, EntityManagerInterface $manager): Response
{
    $user = $this->getUser();

    if (!$user) {
        throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');
    }

    $form = $this->createForm(LivraisonType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        if ($form->get('favoris')->getData()) {
            $user->setAdresseFav($user->getAdresse());
            $user->setCodeFav($user->getCodePostal());
            $user->setVilleFav($user->getVille());
            $manager->persist($user);
        }
    

        $adresse = $user->getAdresse();
        $codePostal = $user->getCodePostal();
        $ville = $user->getVille();
    
        if ($adresse !== null) {
            $user->setAdresse($adresse);
        }
    
        if ($codePostal !== null) {
            $user->setCodePostal($codePostal);
        }
    
        if ($ville !== null) {
            $user->setVille($ville);
        }
    
        $manager->persist($user);
        $manager->flush();
    
        $this->addFlash('success', 'Vos informations ont été mises à jour avec succès.');
    
        return $this->redirectToRoute('app_livraison');
    }

    return $this->render('livraison/index.html.twig', [
        'form2' => $form->createView(),
    ]);
}
}
