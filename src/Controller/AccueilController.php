<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticlesRepository;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(ArticlesRepository $articleRepository): Response
    {
        $articles = $articleRepository->findLimit(3);

        return $this->render('accueil/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
