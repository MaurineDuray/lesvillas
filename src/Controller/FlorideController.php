<?php

namespace App\Controller;

use App\Repository\ImmosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlorideController extends AbstractController
{
    #[Route('/floride', name: 'floride')]
    public function index(ImmosRepository $repo): Response
    {
        $immos = $repo->findByConciergerie("Floride");
        return $this->render('logement/floride.html.twig', [
            'immos' => $immos,
        ]);
    }
}
