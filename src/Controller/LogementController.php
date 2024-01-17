<?php

namespace App\Controller;

use App\Entity\Immos;
use Cocur\Slugify\Slugify;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ImmosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LogementController extends AbstractController
{
    
    #[Route('/logement/{id}', name: 'logement')]
    public function showLogement( Immos $immo, Request $request, EntityManagerInterface $manager, MailerInterface $mailer):Response
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
            
            // mail send
            $email = (new TemplatedEmail())
            ->from('site@lesvillasblue.be')
            ->to('contact@lesvillasblue.be')
            ->subject('Pre-reservation')
            ->htmlTemplate('mails/reservation.html.twig')
            ->context([
               'booking'=>$reservation,
               'titlefr'=>$immo->getTitre(),
                'titleen'=>$immo->getTitreEn(),
                'titlees'=>$immo->getTitreEs(),
                'arrival'=>$reservation->getArrival()->format('Y-m-d'),
                'departure'=>$reservation->getDeparture()->format('Y-m-d')
            ]);
           $mailer->send($email);
           
            // récap réservation
            $emailrecap = (new TemplatedEmail())
            ->from('site@lesvillasblue.be')
            ->to($reservation->getEmail())
            ->subject('Pre-reservation Villas Blue')
            ->htmlTemplate('mails/recapreservation.html.twig')
            ->context([
                'booking'=>$reservation,
                'titlefr'=>$immo->getTitre(),
                'titleen'=>$immo->getTitreEn(),
                'titlees'=>$immo->getTitreEs(),
                'arrival'=>$reservation->getArrival()->format('Y-m-d'),
                'departure'=>$reservation->getDeparture()->format('Y-m-d')
            ]);
            $mailer->send($emailrecap);

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
