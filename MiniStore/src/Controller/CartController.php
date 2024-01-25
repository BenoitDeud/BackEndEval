<?php

namespace App\Controller;


use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cart', name: 'cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitsRepository $produitsRepository)
    {
        $panier = $session->get('panier', []);

        // On initialise des variables
        $data = [];
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $produits = $produitsRepository->find($id);

            $data[] = [
                'produits' => $produits,
                'quantite' => $quantite
            ];
            $total += $produits->getPrix() * $quantite;
        }

        return $this->render('cart/index.html.twig', compact('data', 'total'));
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Produits $produits, SessionInterface $session, Request $request)
    {
        // On récup l'id du produit
        $id = $produits->getId();

        //On récup le panier existant
        $panier = $session->get('panier', []);

        // On récupère la quantité choisie par l'utilisateur
        $quantite = $request->request->get('quantity');

        // On ajoute le produit dans le panier si il n'y est pas encore
        // sinon on incrémente qté

        if (empty($panier[$id])) {
            $panier[$id] = $quantite;
        } else {
            $panier[$id] += $quantite;
        }

        $session->set('panier', $panier);

        //On redirigige vers la page du panier
        return $this->redirectToRoute('app_produits_index');
    }

    #[Route('/update/{id}', name: 'update')]
    public function update(Produits $produits, SessionInterface $session, Request $request)
    {
        // On récup l'id du produit
        $id = $produits->getId();

        //On récup le panier existant
        $panier = $session->get('panier', []);

        // On récupère la nouvelle quantité choisie par l'utilisateur
        $quantite = $request->request->get('quantity');

        // On vérifie que la quantité choisie est inférieure ou égale au stock disponible
        if ($quantite <= $produits->getStock()) {
            // On met à jour la quantité de l'article dans le panier
            $panier[$id] = $quantite;
        } else {
            // On met la quantité à la valeur du stock disponible
            $panier[$id] = $produits->getStock();
        }

        $session->set('panier', $panier);

        //On redirigige vers la page du panier
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produits $produits, SessionInterface $session)
    {
        // On récup l'id du produit
        $id = $produits->getId();

        //On récup le panier existant
        $panier = $session->get('panier', []);

        // Si panier pas vide il le devient

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        //On redirigige vers la page du panier
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/empty', name: 'empty')]
    public function empty(SessionInterface $session)
    {
        $session->remove('panier');

        return $this->redirectToRoute('cart_index');
    }
}
?>