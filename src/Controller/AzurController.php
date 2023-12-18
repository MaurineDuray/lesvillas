<?php

namespace App\Controller;

use App\Entity\Immos;
use App\Form\SearchType;
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
            $immos = $repo->findByConciergerie("Azur");
            return $this->render('logement/azur.html.twig', [
                'search'=>$searchForm->createView(),
                'immos' => $immos,
            ]);
        }

       
    
    }

    
}
