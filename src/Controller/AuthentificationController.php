<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthentificationController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('authentification/login.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    #[Route('/sign-in', name: 'app_sign-in')]
    public function signin(): Response
    {
        return $this->render('authentification/sign-in.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

}
