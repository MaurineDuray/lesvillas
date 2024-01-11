<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre message a bien été envoyé ! / Your message has been successfully sent! "
            );
            
        
            // mail send
            $email = (new TemplatedEmail())
            ->from('site@lesvillasblue.be')
            ->to('contact@lesvillasblue.be')
            ->subject('Contact')
            ->htmlTemplate('mails/contact.html.twig')
            ->context([
               'contact'=>$contact
            ]);
           $mailer->send($email);
           
            // récap contact
            $emailrecap = (new TemplatedEmail())
            ->from('site@lesvillasblue.be')
            ->to('contact@lesvillasblue.be')
            ->subject('Contact Villas Blue')
            ->htmlTemplate('mails/recapcontact.html.twig')
            ->context([
                'contact'=>$contact
            ]);
            $mailer->send($emailrecap);

            return $this->redirectToRoute('contact', [
                
            ]);
        }

        return $this->render("contact/index.html.twig",[
            'myform'=>$form->createView()
        ]);
    }
}
