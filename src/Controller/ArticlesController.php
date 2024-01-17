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
    /*
    Cette page est essentiellement la page de recherche d'articles, et la boutique en général.
    Il est possible de modifier le nombre d'articles par page, et de rechercher par nom/rayon.
    La méthode employée n'est pas celle préconisée par Symfony, puisqu'elle ne tombe pas dans les cas d'utilisation classique
    */
    #[Route('/articles', name: 'app_tous_articles')]
    public function tousArticles(ArticlesRepository $articleRepository, RayonsRepository $rayonsRepository): Response
    {
        $page = 0;
        $max_articles = 3; // Modifier ici le nombre d'articles par page
        
        $nom = null;
        $rayon = null;

        $rayons = $rayonsRepository->findAll(); // Permet de sélectionner tous les rayons dans la recherche

        if (isset($_GET["page"])) { $page = $_GET["page"]; } // Récupération de la dernière page de l'utilisateur

        if (isset($_GET['nom'])) { $nom = $_GET['nom']; } // Récup du nom de l'article recherché
        if (isset($_GET['rayon'])) { $rayon = $_GET['rayon']; } // Récup du rayon recherché

        if ($nom == null and $rayon == null) {
            // Tous les articles. Pourrait ne rechercher qu'un nombre limité d'articles
            $articles = $articleRepository->findAll();
        } else {
            // Recherche d'article par nom/rayon
            $articles = $articleRepository->findSearch($nom, $rayon); 
        }
        
        return $this->render('articles/tous_articles.html.twig', [
            'articles' => array_slice($articles, $page*$max_articles, $max_articles), // Limite ici au lieu de la requête
            'rayons' => $rayons,
            "page" => $page,
            'estderniere' => ( count($articles) <= ($page+1)*$max_articles ), // Permet de ne pas afficher "page suivante"
            'nom' => $nom,
            'rayon' => $rayon
        ]);
    }
    
    /**
    * Page d'un article
    * Contient toutes les informations d'un produit.
    * 
    * Prend en paramètre l'ID du produit dans l'URL
    * Renvoie l'objet article, la référence et le stock "internet"  
    */
    #[Route('/articles/{id}', name: 'app_articles')]
    public function index(int $id, ArticlesRepository $articleRepository, StockageRepository $stockageRepository): Response
    {
        $article = $articleRepository->find($id);

        if ($article == null) {
            // TODO: Page d'erreur
            return $this->render('accueil/index.html.twig');
        }

        /*
        Etapes pour la référence:
        Récupèrer le nom du fournisseur, sans espace
        Récupèrer le nom du rayon, sans espace
        Garder les trois premières lettres des deux
        Rajouter l'identifiant, sur 12 caractères
        */
        $fou = str_replace(" ", "", $article->getLeFournisseur()->getNom());
        $ray = str_replace(" ", "", $article->getFkRayons()->getNom());
        $reference = substr($fou, 0, 3).substr($ray, 0, 3).sprintf("%012d", $id);

        // TODO: Stock internet sera obsolète dès l'implémentation du lot B.
        // Déterminer le stock (internet)
        $stockinternet = $stockageRepository->findByArticle($id); // Récupèrer les stocks
        if (count($stockinternet) < 1) { // S'il n'y a aucun résultat
            $stockinternet = 0; // Alors il n'y a pas d'articles
        } else {
            $stockinternet = $stockinternet[0]->getQuantite(); // Sinon, quantité du premier (et seul) résultat
        }

        return $this->render('articles/index.html.twig', [
            'article' => $article,
            'reference' => $reference,
            'stockinternet' => $stockinternet
        ]);
    }
}
