<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticlesRepository;

class AccueilController extends AbstractController
{
    /**
    * Page d'accueil
    * 
    * Renvoie une liste d'articles
    */
    #[Route('/accueil', name: 'app_accueil')]
    public function index(ArticlesRepository $articleRepository): Response
    {
        // Actuellement, récupère les 3 premiers, sans critère.
        $articles = $articleRepository->findLimit(3);

        return $this->render('accueil/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
