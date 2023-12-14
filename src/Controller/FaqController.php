<?php

namespace App\Controller;

use App\Repository\FaqRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends AbstractController
{
    #[Route('/faq', name: 'faq')]
    public function index(FaqRepository $repo): Response
    {
        $questions = $repo->findAll();
        return $this->render('faq/index.html.twig', [
            'questions' => $questions,
        ]);
    }
}
