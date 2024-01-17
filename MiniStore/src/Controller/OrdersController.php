<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Entity\DetailsCommandes;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commandes', name: 'app_orders_')]
class OrdersController extends AbstractController
{
    #[Route('/checkout', name: 'checkout')]
    public function checkout(SessionInterface $session, ProduitsRepository $produitsRepository, EntityManagerInterface $em): Response
    {
        // On récupère le panier existant
        $panier = $session->get('panier', []);

        // Si le panier est vide, on redirige vers la page d'accueil avec un message
        if ($panier === []) {
            $this->addFlash('Message', 'Votre panier est vide');
            return $this->redirectToRoute('app_home');
        }

        // Le panier n'est pas vide, on peut passer à la commande
        $commande = new Commandes();

        // On récupère l'utilisateur connecté
        $commande->setUser($this->getUser());

        // On génère une référence unique pour la commande
        $commande->setReference(uniqid());

        // On parcourt tous les articles dans le panier
        // On parcourt tous les articles dans le panier
        foreach ($panier as $id => $quantite) {
            // On récupère le produit de la base de données
            $produit = $produitsRepository->find($id);

            // On diminue le stock du produit de la quantité dans le panier
            $produit->setStock($produit->getStock() - $quantite);

            // Créer une nouvelle instance de DetailsCommandes
            $detailsCommande = new DetailsCommandes();
            $detailsCommande->setProduits($produit);
            $detailsCommande->setQuantite($quantite);
            $detailsCommande->setPrix($produit->getPrix());

            // On ajoute les détails de la commande à la commande
            $commande->addDetailsCommande($detailsCommande);

            // On enregistre le produit mis à jour dans la base de données
            $em->persist($produit);
        }

        // On enregistre la commande dans la base de données
        $em->persist($commande);
        $em->flush();

        // On vide le panier
        $session->remove('panier');

        // On redirige vers la page de commande avec un message
        $this->addFlash('Message', 'Votre commande a bien été enregistrée');

        return $this->render('orders/index.html.twig', [
            'controller_name' => 'OrdersController',
        ]);
    }
}
