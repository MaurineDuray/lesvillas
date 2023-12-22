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
                "Votre demande de réservation a bien été envoyée, nous revenons vers vous au plus vite ! / Your booking request has been sent, we'll get back to you as soon as possible  ! "
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

    

        
}
