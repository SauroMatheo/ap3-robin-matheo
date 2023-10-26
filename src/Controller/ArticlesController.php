<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticlesRepository;
use App\Repository\ImageArticleRepository;
use App\Repository\StockageRepository;

use App\Model\RechercheData;
use App\Form\RechercheType;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_tous_articles')]
    public function tousArticles(ArticlesRepository $articleRepository, Request $request): Response
    {
        $page = 0;
        $nom = '';
        $max_articles = 32;

        $rechercheData = new RechercheData();
        $form = $this->createForm(RechercheType::class, $rechercheData);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($rechercheData);
        }

        if (isset($_GET["page"])) { $page = $_GET["page"]; }
        if (isset($_GET['nom'])) { $nom = $nom.$_GET['nom']; }

        // $articles = $articleRepository->findAll();
        $articles = $articleRepository->findLimOff($max_articles, $page*$max_articles);
        // $articles = $articleRepository->condLimOff($max_articles, $page*$max_articles, $nom);
        
        return $this->render('articles/tous_articles.html.twig', [
            'form' => $form->createView(),
            'articles' => $articles,
            "page" => $page,
            'estderniere' => ( count($articles) < $max_articles )
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
