<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticlesRepository;
use App\Repository\ImageArticleRepository;
use App\Repository\StockageRepository;
use App\Repository\RayonsRepository;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_tous_articles')]
    public function tousArticles(ArticlesRepository $articleRepository, RayonsRepository $rayonsRepository): Response
    {
        $page = 0;
        $max_articles = 3;
        
        $nom = null;
        $rayon = null;

        $rayons = $rayonsRepository->findAll();

        if (isset($_GET["page"])) { $page = $_GET["page"]; }

        if (isset($_GET['nom'])) { $nom = $_GET['nom']; }
        if (isset($_GET['rayon'])) { $rayon = $_GET['rayon']; }

        if ($nom == null and $rayon == null) {
            $articles = $articleRepository->findAll();
        } else {
            $articles = $articleRepository->findSearch($nom, $rayon); 
        }
        
        return $this->render('articles/tous_articles.html.twig', [
            'articles' => array_slice($articles, $page*$max_articles, $max_articles),
            'rayons' => $rayons,
            "page" => $page,
            'estderniere' => ( count($articles) <= ($page+1)*$max_articles ),
            'nom' => $nom,
            'rayon' => $rayon
        ]);
    }
    
    #[Route('/articles/{id}', name: 'app_articles')]
    public function index(int $id, ArticlesRepository $articleRepository, StockageRepository $stockageRepository): Response
    {
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
}
