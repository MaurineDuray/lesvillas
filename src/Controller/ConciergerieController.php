<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConciergerieController extends AbstractController
{
    #[Route('/conciergerie', name: 'conciergerie')]
    public function index(): Response
    {
        return $this->render('conciergerie/index.html.twig', [
            'controller_name' => 'ConciergerieController',
        ]);
    }
}
