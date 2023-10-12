<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticlesRepository;
use App\Repository\ImageArticleRepository;
use App\Repository\StockageRepository;

use App\Entity\Rayons;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(ArticlesRepository $articleRepository, ImageArticleRepository $imageRepository, StockageRepository $stockageRepository): Response
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        
            $article = $articleRepository->find($id);
    
            if ($article == null) {
                // TODO: Page d'erreur
                return $this->render('accueil/index.html.twig');
            }
    
            // TODO: Référence = FOURAY123456789012
    
            $fou = str_replace(" ", "", $article->getLeFournisseur()->getNom());
            $ray = str_replace(" ", "", $article->getFkRayons()->getNom());
            $reference = substr($fou, 0, 3).substr($ray, 0, 3).sprintf("%012d", $id);
    
            $stockinternet = $stockageRepository->findByArticle($id);
            if (count($stockinternet) < 1) {
                $stockinternet = 0;
            } else {
                $stockinternet = $stockinternet[0]->getQuantite();
            }
    
            return $this->render('articles/index.html.twig', [
                'article' => $article,
                'reference' => $reference,
                'stockinternet' => $stockinternet
            ]);
        }

        $articles = $articleRepository->findAll();
        
        return $this->render('articles/tous_articles.html.twig', [
            'articles' => $articles
        ]);
    }
}
