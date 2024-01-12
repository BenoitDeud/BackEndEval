<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Entity\DetailsCommandes;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commandes', name: 'app_orders_')]
class OrdersController extends AbstractController
{
    #[Route('/ajout', name: 'add')]
    public function add(SessionInterface $session, ProduitsRepository $produitsRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);

        if ($panier === []) {
            $this->addFlash('Message', 'Votre panier est vide');
            return $this->redirectToRoute('app_home');
        }

        // le panier n'est pas vide on peut passer à la commande
        $order = new Commandes();

        // On récupère l'utilisateur connecté
        $order->setUser($this->getUser());
        $order->setReference(uniqid());

        foreach ($panier as $id => $quantity) {
            $orderDetails = new DetailsCommandes();

            //On va rechercher le produit
            $product = $produitsRepository->find($id);
            
            $prix = $product->getPrix();

            // On crée le détail de la commande
            $orderDetails->setProduits($product)
                ->setQuantite($quantity)
                ->setPrix($prix);
            
            // On ajoute le détail à la commande
            $order->addDetailsCommande($orderDetails);
        }
        //On persiste et flush la commande
        $entityManagerInterface->persist($order);
        $entityManagerInterface->flush();

        // On vide le panier
        $session->remove('panier');

        // On redirige vers la page de commande
        $this->addFlash('Message', 'Votre commande a bien été enregistrée');
        return $this->redirectToRoute('app_home');
    }
}
