<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\MagasinsRepository;
use App\Repository\RayonsRepository;

class MagasinController extends AbstractController
{
    #[Route('/magasin', name: 'app_magasin')]
    public function index(MagasinsRepository $magasinsRepository): Response
    {
        $magasins = $magasinsRepository->findAll();

        return $this->render('magasin/index.html.twig', [
            'magasins' => $magasins,
        ]);
    }

    #[Route('/rayon/{magasin}', name: 'app_rayon')]
    public function rayon(MagasinsRepository $magasinsRepository, RayonsRepository $rayonsRepository): Response
    {
        $magasins = $magasinsRepository->findAll();
        // $rayons = $magasins->getArticles;

        return $this->render('magasin/rayons.html.twig', [
            'magasin' => $magasin,
            //  'rayons' => $rayons
        ]);
    }
}
