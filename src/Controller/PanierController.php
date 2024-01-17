<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticlesRepository;

class PanierController extends AbstractController
{
    /**
    * Page du Panier
    * Renvoie une liste d'articles (du panier), la quantité de chaque article, ainsi que le montant total
    */
    #[Route('/panier', name: 'app_panier')]
    public function index(ArticlesRepository $articleRepository): Response
    {
        // TODO: Panier
        // Faux panier, constitué d'IDs et quantité. A remplacer par articleCommande 
        $panierId = [1, 2, 5, 3, 4, 6, 7];
        $panierQte = [3, 5, 1, 2, 1, 1, 2];


        $articles = [];
        $total = 0;

        // Pour chaque ID d'article dans le (faux) panier, trouver l'article et l'ajouter au montant total 
        for ($i=0;$i<count($panierId);$i++) {
            $article = $articleRepository->find($panierId[$i]); // Trouver article
            array_push($articles, $article); // Stocker article
            $total += 1.2 * $article->getPrixUniHT() * $panierQte[$i]; // Ajouter au total
        }


        return $this->render('panier/panier.php.twig', [
            'articles'=>$articles,
            'quantites'=>$panierQte,
            'total'=>$total
        ]);
    }
}
