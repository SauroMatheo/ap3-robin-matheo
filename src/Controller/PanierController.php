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
        $panierId = [1, 2];
        $panierQte = [3, 5];
        $articles = [];

        foreach ($panierId as $id) {
            array_push($articles, $articleRepository->find($id));
        }


        return $this->render('panier/panier.php.twig', [
            'articles'=>$articles,
        ]);
    }
}
