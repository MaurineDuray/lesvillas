<?php

namespace App\Controller;

use App\Entity\Immos;
use App\Form\SearchType;
use App\Repository\ImmosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/floride/sort', name: 'sort', methods: ['GET'])]
    public function sort(Request $request, EntityManagerInterface $manager):Response
    {
       
        $searchForm = $this->createForm(SearchType::class);
        $type = $request->query->get('housetype');
        $travellers = $request->query->get('travellers');
        $bedrooms = $request->query->get('bedrooms');
        $conciergerie = $request->query->get('conciergerie');
        

        $repository = $manager->getRepository(Immos::class);
        $queryBuilder = $repository->createQueryBuilder('i');
        $queryBuilder->orderBy('i.id',"ASC");

        if ($type) {
            $queryBuilder
                ->andWhere('i.type = :type')
                ->setParameter('type', $type);
        }

        if ($travellers) {
            $queryBuilder
                ->andWhere('i.travellers >= :travellers')
                ->setParameter('travellers', $travellers);
        }

        if ($bedrooms) {
            $queryBuilder
                ->andWhere('i.bedrooms >= :bedrooms')
                ->setParameter('bedrooms', $bedrooms);
        }

        if ($conciergerie) {
            $queryBuilder
                ->andWhere('i.conciergerie = :conciergerie')
                ->setParameter('conciergerie', $conciergerie);
        }



        $immos = $queryBuilder->getQuery()->getResult();

        return $this->render('logement/result.html.twig',[
            'immos'=>$immos,
            'search'=>$searchForm->createView(),
        ]);

    }
}
