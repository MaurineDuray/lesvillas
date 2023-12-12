<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AzurController extends AbstractController
{
    #[Route('/azur', name: 'azur')]
    public function index(): Response
    {
        return $this->render('azur/index.html.twig', [
            'controller_name' => 'AzurController',
        ]);
    }
}
