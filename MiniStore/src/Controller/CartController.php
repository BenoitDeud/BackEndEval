<?php

namespace App\Controller;


use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
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
    public function add(Produits $produits, SessionInterface $session)
    {
        // On récup l'id du produit
        $id = $produits->getId();

        //On récup le panier existant
        $panier = $session->get('panier', []);

        // On ajoute le produit dans le panier si il n'y est pas encore
        // sinon on incrémente qté

        if (empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }

        $session->set('panier', $panier);

        //On redirigige vers la page du panier
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produits $produits, SessionInterface $session)
    {
        // On récup l'id du produit
        $id = $produits->getId();

        //On récup le panier existant
        $panier = $session->get('panier', []);

        // On retire le produit du panier si il n'y a qu'un exemplaire
        // sinon on décrémente qté

        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
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