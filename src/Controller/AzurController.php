<?php

namespace App\Controller;

use App\Entity\Immos;
use App\Repository\ImmosRepository;
use Doctrine\Inflector\Rules\Pattern;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AzurController extends AbstractController
{
    #[Route('/azur', name: 'azur')]
    public function index(ImmosRepository $repo): Response
    {
        $immos = $repo->findByConciergerie("Azur");
        return $this->render('logement/azur.html.twig', [
            'immos' => $immos,
        ]);
    }

    
}
