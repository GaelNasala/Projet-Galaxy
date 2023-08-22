<?php

namespace App\Controller;

use App\Entity\Jeux;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session, ManagerRegistry $doctrine): Response
    {
        # On récupère la session 'panier' si elle existe - sinon elle est créée avec un tableau vide
        $panier = $session->get('panier', []);

        $panierData = [];

        foreach ($panier as $id => $quantity) {
            $panierData[] = [
                "jeux" => $doctrine->getRepository(Jeux::class)->find($id),
                "quantity" => $quantity
            ];
        }

        # On calcule le total du panier ici, afin de ne pas avoir à le faire dans la vue Twig
        $total = 0;
        foreach ($panierData as $id => $value) {
            $total += $value['product']->getPrix() * $value['quantity'];
        }
    
        return $this->render('panier/index.html.twig', [
            "items" => $panierData,
            "total" => $total
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function panierAdd($id, SessionInterface $session)
    {
        # ETAPE 1 : On récupère la session 'panier' si elle existe - sinon elle est créée avec un tableau vide
        $panier = $session->get('panier', []);

        # ETAPE 2 : On ajoute la quantité 1, au produit d'id $id
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        # ETAPE 3 : On remplace la variable de session panier par le nouveau tableau $panier
        $session->set('panier', $panier);

        dd($session->get('panier', []));
    }

    /**
     * @Route("/panier/delete/{id}", name="panier_delete")
     */
    public function delete($id, SessionInterface $session)
    {
        # On récupère la session 'panier' si elle existe - sinon elle est créée avec un tableau vide
        $panier = $session->get('panier', []);

        # On supprime de la session celui dont on a passé l'id
        if (!empty($panier[$id])) {
            unset($panier[$id]); // unset pour dépiler de la session
        }

        # On réaffecte le nouveau panier à la session
        $session->set('panier', $panier);

        # On redirige vers le panier
        return $this->redirectToRoute('panier');
    }
}
