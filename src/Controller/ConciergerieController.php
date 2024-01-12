<?php

namespace App\Controller;

use App\Entity\Conciergerie;
use App\Entity\User;
use App\Form\ConciergerieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConciergerieController extends AbstractController
{
    #[Route('/conciergerie', name: 'conciergerie')]
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $contact = new Conciergerie;
        $form = $this->createForm(ConciergerieType::class, $contact);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($contact);
            $manager->flush();

            // mail send
            $email = (new TemplatedEmail())
            ->from('site@lesvillasblue.be')
            ->to('contact@lesvillasblue.be')
            ->subject('Conciergerie Villas Blue')
            ->htmlTemplate('mails/conciergerie.html.twig')
            ->context([
               'contact'=>$contact,
            ]);
           $mailer->send($email);
           
            // récap réservation
             $emailrecap = (new TemplatedEmail())
             ->from('site@lesvillasblue.be')
             ->to('contact@lesvillasblue.be')
             ->subject('Conciergerie Villas Blue')
             ->htmlTemplate('mails/recapconciergerie.html.twig')
             ->context([
                'contact'=>$contact,
             ]);
            $mailer->send($emailrecap);
            

            $this->addFlash(
                'success',
                "Votre demande a bien été envoyée ! / Your request has been sent!"
            );

            return $this->redirectToRoute('contact', [
                
            ]);
        }

        return $this->render("conciergerie/index.html.twig",[
            'myform'=>$form->createView()
        ]);
    }

     
}
