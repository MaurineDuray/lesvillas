<?php

namespace App\Controller;

use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnersController extends AbstractController
{
    #[Route('/partners', name: 'partners')]
    public function index(PartnersRepository $repo): Response
    {
        $partners = $repo->findAll();
        return $this->render('partners/index.html.twig', [
            'partners' =>$partners,
        ]);
    }
}
