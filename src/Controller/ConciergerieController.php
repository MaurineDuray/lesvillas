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
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $contact = new Conciergerie;
        $form = $this->createForm(ConciergerieType::class, $contact);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($contact);
            $manager->flush();

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

     /**
     * Route qui permet de notifier un auteur d'une demande de contact par l'utilisateur connecté
     */
    #[Route('/user/contact/{id}', name: 'contact_mail')]
    public function contactUser(User $user, Request $request, MailerInterface $mailer, EntityManagerInterface $manager, UserInterface $utilisateur):Response
    {
            $id = $user->getId();
            $user = $manager->getRepository(User::class)->findUserById($id);
            $contactmail = $user->getEmail();

             // mail send
             $email = (new TemplatedEmail())
             ->from('design@maurine.be')
             ->to($contactmail)
             ->subject('Contact')
             ->htmlTemplate('mails/contact.html.twig')
             ->context([
                'utilisateur' => $utilisateur,
                'user'=>$user
             ]);
            $mailer->send($email);
            
            $this->addFlash(
                'success',
                'L\'utilisateur a bien été notifiée de votre demande de contact!'
            );

            return $this->redirectToRoute('home');
    
    }
}
