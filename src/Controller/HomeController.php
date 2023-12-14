<?php

namespace App\Controller;

use App\Repository\ImmosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ImmosRepository $repo): Response
    {
        $immosAzur =$repo->findByTopAzur("Azur");
        $immosFloride =$repo->findByTopFloride("Floride");

        return $this->render('home/index.html.twig', [
            'immosAzur' => $immosAzur,
            'immosFloride'=> $immosFloride
        ]);
    }
}
