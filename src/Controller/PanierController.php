<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticlesRepository;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(ArticlesRepository $articleRepository): Response
    {
        $panierId = [1, 2, 5, 3, 4, 6, 7];
        $panierQte = [3, 5, 1, 2, 1, 1, 2];
        $articles = [];
        $total = 0;

        for ($i=0;$i<count($panierId);$i++) {
            $article = $articleRepository->find($panierId[$i]);
            array_push($articles, $article);
            $total += 1.2 * $article->getPrixUniHT() * $panierQte[$i];
        }


        return $this->render('panier/panier.php.twig', [
            'articles'=>$articles,
            'quantites'=>$panierQte,
            'total'=>$total
        ]);
    }
}
