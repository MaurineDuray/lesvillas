<?php

namespace App\Controller;

use App\Entity\Immos;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ImmosRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LogementController extends AbstractController
{
    
    #[Route('/logement/{id}', name: 'logement')]
    public function showLogement( Immos $immo, Request $request, EntityManagerInterface $manager):Response
    {

        $reservation = new Reservation;
        $form = $this->createForm(ReservationType::class, $reservation);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $reservation->setImmoId($immo);
            $manager->persist($reservation);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre demande de réservation a bien été envoyé ! / Your booking request has been sent ! "
            );
            

            return $this->redirectToRoute('logement', [
                'id' => $immo->getId()
            ]);
        }
        return $this->render('logement/logement.html.twig', [
            'immo'=>$immo,
            'myform'=>$form->createView()
        ]);


    }

    #[Route('/logement/sort', name: 'sort')]
    public function sort(ImmosRepository $repo, Request $request, EntityManagerInterface $manager):Response
    {
        $type = $request->query->get('housetype');
        $travellers = $request->query->get('travellers');
        $rooms = $request->query->get('rooms');
        $price = $request->query->get('price');

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
                ->andWhere('i.travellers = :travellers')
                ->setParameter('travellers', $travellers);
        }

        if ($rooms) {
            $queryBuilder
                ->andWhere('i.rooms = :rooms')
                ->setParameter('rooms', $rooms);
        }

        if ($price) {
            $queryBuilder
                ->andWhere('i.price < :price')
                ->setParameter('price', $price);
        }

        $immos = $queryBuilder->getQuery()->getResult();

        return $this->render('logement/result.html.twig',[
            'immos'=>$immos,
        ]);

    }


}
