<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ImmosRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FlorideController extends AbstractController
{
    #[Route('/floride', name: 'floride')]
    public function index(ImmosRepository $repo, Request $request): Response
    {
        $searchForm = $this->createForm(SearchType::class);
       
        if ($searchForm->handleRequest($request)->isSubmitted() && $searchForm->isValid()){
            $criteria = $searchForm['search']->getData();
            $immos = $repo->findByCriteria($criteria);
            return $this->render('logement/search.html.twig', [
                'immos' => $immos,
                'search'=>$searchForm->createView(),
                'criteria'=>$criteria,
            ]);
        }else{
            $immos = $repo->findByConciergerie("Floride");
            return $this->render('logement/floride.html.twig', [
                'search'=>$searchForm->createView(),
                'immos' => $immos,
            ]);
        }

    }
}
