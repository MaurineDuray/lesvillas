<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlorideController extends AbstractController
{
    #[Route('/floride', name: 'floride')]
    public function index(): Response
    {
        return $this->render('floride/index.html.twig', [
            'controller_name' => 'FlorideController',
        ]);
    }
}
