<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticlesRepository;

use App\Entity\Rayons;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(ArticlesRepository $articleRepository): Response
    {
        $id = $_GET['id'];
        
        $article = $articleRepository->find($id);

        $prixht = floatval(str_replace(',', '.', $article->getPrixUniHT()));
        $prixttc = round($prixht * 1.2, 2);

        // TODO: Référence = FOURAY123456789012

        $fou = str_replace(" ", "", $article->getLeFournisseur()->getNom());
        $ray = str_replace(" ", "", $article->getFkRayons()->getNom());
        $reference = substr($fou, 0, 3).substr($ray, 0, 3).sprintf("%012d", $id);

        return $this->render('articles/index.html.twig', [
            'article' => $article,
            'prixht' => $prixht,
            'prixttc' => $prixttc,
            'reference' => $reference
        ]);
    }
}
