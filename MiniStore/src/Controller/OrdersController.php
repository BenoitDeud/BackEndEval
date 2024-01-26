<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Entity\DetailsCommandes;
use App\Repository\ProduitsRepository;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
        // Vérifiez si un utilisateur est connecté
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour passer une commande.');
            return $this->redirectToRoute('app_login');
        }
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

        return $this->redirectToRoute('app_orders_delivery', ['orderId' => $commande->getId()]);
    }


    #[Route("/order-delivery/{orderId}", name: "delivery")]
    public function orderSummary($orderId, CommandesRepository $ordersRepository, Request $request, EntityManagerInterface $em)
    {
        $user = $this->getUser(); // Récupère l'utilisateur actuellement connecté
        $addresse = $user->getAdresse();
        $ville = $user->getVille();
        $codePostal = $user->getCodePostal();
        $adresseLivraison1 = $addresse;
        $adresseLivraison2 = $ville . ' ' . $codePostal;

        // Récupérez la commande de la base de données
        $order = $ordersRepository->find($orderId);

        if (!$order) {
            throw $this->createNotFoundException('La commande demandée n\'existe pas.');
        }

        // Récupérez les détails de la commande
        $orderDetails = $order->getDetailsCommandes();

        // Récupérez l'adresse de livraison de la requête
        $name = $request->query->get('name');
        $address = $request->query->get('address');
        $postalCode = $request->query->get('postalCode');
        $city = $request->query->get('city');
        $deliveryAdress = $request->query->get('deliveryAdress');

        // Enregistrez les modifications dans la base de données
        if ($name && $address && $postalCode && $city) {
            $deliveryAdress = $name . ', ' . $address . ', ' . $postalCode . ', ' . $city;
            $order->setAdresseLivraison($deliveryAdress);
            $em->persist($order);
            $em->flush();
        }

        // Passez les détails de la commande à la vue
        return $this->render('orders/index.html.twig', [
            'commande' => $order,
            'orderDetails' => $orderDetails,
            'adresseLivraison1' => $adresseLivraison1,
            'adresseLivraison2' => $adresseLivraison2,
            'codePostal' => $codePostal,
            'ville' => $ville,
            'deliveryAdress' => $deliveryAdress ?? null
        ]);
    }

    #[Route('/order-summary/{orderId}', name: 'summary', methods: ['GET'])]

    public function showOrderDetail($orderId, CommandesRepository $ordersRepository, Request $request, EntityManagerInterface $em): Response
    {
        // Récupérez la commande de la base de données
        $order = $ordersRepository->find($orderId);

        // Récupérez les détails de la commande
        $orderDetails = $order->getDetailsCommandes();

        // Récupérez l'adresse de livraison de la requête
        $name = $request->query->get('name');
        $address = $request->query->get('address');
        $postalCode = $request->query->get('postalCode');
        $city = $request->query->get('city');

        // Enregistrez les modifications dans la base de données
        if ($name && $address && $postalCode && $city) {
            $deliveryAdress = $name . ', ' . $address . ', ' . $postalCode . ', ' . $city;
            $order->setAdresseLivraison($deliveryAdress);
            $em->persist($order);
            $em->flush();

        }

        $total = 0;
        foreach ($orderDetails as $detail) {
            $total += $detail->getQuantite() * $detail->getPrix();
        }

        // Renvoyer la vue du récapitulatif de commande avec les informations de la commande
        return $this->render('orders/resume.html.twig', [
            'order' => $order,
            'orderDetails' => $orderDetails,
            'deliveryAdress' => $deliveryAdress ?? null,
            'total' => $total
        ]);
    }

    #[Route('/order-all', name: 'all')]
    public function allOrder(CommandesRepository $commandes): Response
    {
        $user = $this->getUser(); // Récupère l'utilisateur actuellement connecté
        $orders = $commandes->findBy(['user' => $user], ['id' => 'DESC']);

        $commandesDetails = [];
        foreach ($orders as $order) {
            $details = $order->getDetailsCommandes(); // Récupère les détails de la commande

            $total = 0;
            foreach ($details as $detail) {
                $total += $detail->getQuantite() * $detail->getPrix();
            }

            $commandesDetails[] = [
                'order' => $order,
                'details' => $details,
                'total' => $total
            ];
        }

        return $this->render('orders/order_by_user.html.twig', [
            'commandesDetails' => $commandesDetails,
        ]);
    }
}