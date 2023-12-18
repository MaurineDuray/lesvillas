<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Entity\Immos;
use App\Form\FaqType;
use App\Entity\Images;
use App\Entity\Contact;
use App\Form\ImageType;
use App\Form\ImmosType;
use App\Entity\Partners;
use App\Entity\Activities;
use App\Form\ActivityType;
use App\Form\PartnersType;
use App\Entity\Reservation;
use App\Entity\Conciergerie;
use App\Form\UpdateImmoType;
use App\Entity\ImmoImgModify;
use App\Form\UpdateImmosType;
use App\Security\UserChecker;
use App\Form\ImmoImgModifyType;
use App\Form\UpdateActivityType;
use App\Entity\ActivityImgModify;
use App\Repository\FaqRepository;
use App\Repository\UserRepository;
use App\Form\ActivityImgModifyType;
use App\Repository\ImmosRepository;
use App\Repository\ImagesRepository;
use App\Repository\ContactRepository;
use App\Repository\PartnersRepository;
use App\Repository\ActivitiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use App\Repository\ConciergerieRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminController extends AbstractController
{
    #[Route('/adminvillasblue', name: 'admin')]
    #[IsGranted("ROLE_ADMIN")]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/adminlogement', name: 'admin_logement')]
    public function adminLogements(ImmosRepository $repo):Response
    {
        $immos = $repo->findAll();
        return $this->render('admin/logements.html.twig', [
            'immos' => $immos,
        ]);
    } 

    #[Route('/adminactivities', name: 'admin_activities')]
    public function adminActivities(ActivitiesRepository $repo):Response
    {
        $activities = $repo->findAll();
        return $this->render('admin/activities.html.twig', [
            'activities' => $activities,
        ]);
    } 

    #[Route('/adminafaq', name: 'admin_faq')]
    public function adminFaq(FaqRepository $repo):Response
    {
        $questions = $repo->findAll();
        return $this->render('admin/faq.html.twig', [
            'questions' => $questions,
        ]);
    } 

    #[Route('/adminuser', name: 'admin_user')]
    public function adminUser(UserRepository $repo):Response
    {
        $users = $repo->findAll();
        return $this->render('admin/users.html.twig', [
            'users' => $users,
        ]);
    } 

    #[Route('/adminpartners', name: 'admin_partners')]
    public function adminPartners(PartnersRepository $repo):Response
    {
        $partners = $repo->findAll();
        return $this->render('admin/partners.html.twig', [
            'partners' => $partners,
        ]);
    } 

    #[Route('/admincontact', name: 'admin_contacts')]
    public function adminContact(ContactRepository $repo):Response
    {
        $contacts = $repo->findAll();
        return $this->render('admin/contact.html.twig', [
            'contacts' => $contacts,
        ]);
    } 

    #[Route('/admingalery/{id}', name: 'admin_galery')]
    public function adminAddGalery(ImagesRepository $repo, int $id, ImmosRepository $reposi):Response
    {
        $pictures = $repo->findByImmo($id);
        $immo = $reposi->findById($id);
        return $this->render('admin/galery.html.twig', [
            'pictures' => $pictures,
            'immo'=>$immo
        ]);
    } 

    


    #[Route('/admingalery/{id}/add', name: 'admin_galery_add')]
    public function adminGalery(ImagesRepository $repo, int $id, Request $request, EntityManagerInterface $manager, Immos $immo): Response
    {
    
    $image = new Images;
    $form = $this->createForm(ImageType::class, $image);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $file = $form['file']->getData();
        if (!empty($file)) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = transliterator_transliterate('Any-Latin;Latin-ASCII;[^A-Za-z0-9_]remove;Lower()', $originalFilename);
            $newFilename = $safeFilename . "-" . uniqid() . "." . $file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('uploads_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                return $e->getMessage();
            }
            $image->setFile($newFilename);
        }

        $image->setImmoId($manager->getRepository(Immos::class)->find($id));
        $manager->persist($image);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'image a bien été ajoutée"
        );

        return $this->redirectToRoute('admin_galery', [
            'id' => $id,
        ]);
    }

    return $this->render("admin/addgalery.html.twig", [
        'myform' => $form->createView()
    ]);
}


    #[Route("/admingalery/{id}/delete", name: "admin_galery_delete")]
    public function galerydelete(Images $image, EntityManagerInterface $manager): Response
    {
        $immo = $image->getImmoId();
        $this->addFlash(
            'success',
            "L'image {$image->getFile()}</strong> a bien été supprimée"
        );

        unlink($this->getParameter('uploads_directory').'/'.$image->getFile());
        

        $manager->remove($image);
        $manager->flush();

        return $this->redirectToRoute('admin_galery',[
            'id'=>$immo->getId()
        ]);
    }


    #[Route('/admincontact/{id}', name: 'admin_contacts_message')]
    public function adminContactShow(ContactRepository $repo, Contact $message):Response
    {
        return $this->render('admin/message.html.twig', [
            'message'=>$message
        ]);
    } 

    #[Route("/admincontact/{id}/delete", name:"admin_contacts_delete")]
    public function contactdelete(Contact $contact, EntityManagerInterface $manager): Response
    {
        $this->addFlash(
            'success',
            "Le contact {$contact->getId()}</strong> a bien été supprimé"
        );

        $manager->remove($contact);
        $manager->flush();

        return $this->redirectToRoute('admin_contacts');
    }

    #[Route('/adminreservation', name: 'admin_reservations')]
    public function adminReservation(ReservationRepository $repo):Response
    {
        $reservations = $repo->findAll();
        return $this->render('admin/reservations.html.twig', [
            'reservations' => $reservations,
        ]);
    } 

    #[Route('/adminreservation/{id}', name: 'admin_reservations_demande')]
    public function adminreservationsShow(ContactRepository $repo, Reservation $reservation):Response
    {
        return $this->render('admin/reservation.html.twig', [
            'reservation'=>$reservation
        ]);
    } 


    #[Route("/adminreservation/{id}/delete", name:"admin_reservation_delete")]
    public function reservationdelete(Reservation $reservation, EntityManagerInterface $manager): Response
    {
        $this->addFlash(
            'success',
            "Le contact {$reservation->getId()}</strong> a bien été supprimé"
        );

        $manager->remove($reservation);
        $manager->flush();

        return $this->redirectToRoute('admin_reservations');
    }

    #[Route('/adminconciergerie', name: 'admin_conciergerie')]
    public function adminconciergerie(ConciergerieRepository $repo):Response
    {
        $conciergeries = $repo->findAll();
        return $this->render('admin/conciergerie.html.twig', [
            'conciergeries' => $conciergeries,
        ]);
    } 

    #[Route('/adminconciergerie/{id}', name: 'admin_conciergerie_demande')]
    public function adminconciergerieShow(ConciergerieRepository $repo, Conciergerie $conciergerie):Response
    {
        return $this->render('admin/demande.html.twig', [
            'conciergerie'=>$conciergerie
        ]);
    } 

    #[Route("/adminconciergerie/{id}/delete", name:"admin_conciergerie_delete")]
    public function conciergeriedelete(Conciergerie $conciergerie, EntityManagerInterface $manager): Response
    {
        $this->addFlash(
            'success',
            "La demande de conciergerie {$conciergerie->getId()}</strong> a bien été supprimée"
        );

        $manager->remove($conciergerie);
        $manager->flush();

        return $this->redirectToRoute('admin_conciergerie');
    }
    
    #[Route('/adminlogement/add', name: 'admin_logement_add')]
    public function adminImmosAdd(Request $request, EntityManagerInterface $manager):Response
    {
        $immo = new Immos;
        $form = $this->createForm(ImmosType::class, $immo);
        
        
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $file = $form['cover']->getData();
            if (!empty($file)) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin;Latin-ASCII;[^A-Za-z0-9_]remove;Lower()', $originalFilename);
                $newFilename = $safeFilename . "-" . uniqid() . "." . $file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    return $e->getMessage();
                }
                $immo->setCover($newFilename);
            }


            

            $immo->setSlug(rand());
            $manager->persist($immo);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le logement {$immo->getTitre()} a bien été ajouté"
            );

            return $this->redirectToRoute('admin_logement', [
                
            ]);


        }
    
        return $this->render("admin/addlogement.html.twig",[
            'myform'=>$form->createView()
        ]);
    } 

    #[Route('/adminactivities/add', name: 'admin_activity_add')]
    public function adminActivityAdd(Request $request, EntityManagerInterface $manager):Response
    {
        $activity = new Activities;
        $form = $this->createForm(ActivityType::class, $activity);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $file = $form['image']->getData();
            if (!empty($file)) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin;Latin-ASCII;[^A-Za-z0-9_]remove;Lower()', $originalFilename);
                $newFilename = $safeFilename . "-" . uniqid() . "." . $file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    return $e->getMessage();
                }
                $activity->setImage($newFilename);
            }
        
            $activity->setSlug(rand());
            $manager->persist($activity);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'activité {$activity->getTitre()} a bien été ajouté"
            );

            return $this->redirectToRoute('admin_activities', [
                
            ]);
        }

        return $this->render("admin/addActivities.html.twig",[
            'myform'=>$form->createView()
        ]);
    } 

    #[Route('/adminpartners/add', name: 'admin_partners_add')]
    public function adminPartnersAdd(Request $request, EntityManagerInterface $manager):Response
    {
        $partners = new Partners;
        $form = $this->createForm(PartnersType::class, $partners);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $file = $form['logo']->getData();
            if (!empty($file)) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin;Latin-ASCII;[^A-Za-z0-9_]remove;Lower()', $originalFilename);
                $newFilename = $safeFilename . "-" . uniqid() . "." . $file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    return $e->getMessage();
                }
                $partners->setLogo($newFilename);
            }
        
            
            $manager->persist($partners);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le partenaire a bien été ajouté"
            );

            return $this->redirectToRoute('admin_partners', [
                
            ]);
        }

        return $this->render("admin/addPartners.html.twig",[
            'myform'=>$form->createView()
        ]);
    }

    #[Route("/adminpartners/{id}/delete", name:"admin_partner_delete")]
    public function partnersdelete(Partners $partners, EntityManagerInterface $manager): Response
    {
        $this->addFlash(
            'success',
            "Le partners {$partners->getName()}</strong> a bien été supprimée"
        );

        unlink($this->getParameter('uploads_directory').'/'.$partners->getLogo());
        
        $manager->remove($partners);
        $manager->flush();

        return $this->redirectToRoute('admin_partners');
    }
    
    #[Route('/adminfaq/add', name: 'admin_faq_add')]
    public function adminFaqAdd(Request $request, EntityManagerInterface $manager):Response
    {
        $faq = new Faq;
        $form = $this->createForm(FaqType::class, $faq);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($faq);
            $manager->flush();

            $this->addFlash(
                'success',
                "La question a bien été ajouté"
            );

            return $this->redirectToRoute('admin_faq', [
                
            ]);
        }

        return $this->render("admin/addFaq.html.twig",[
            'myform'=>$form->createView()
        ]);
    } 

    /**
     * Permet d'afficher le formulaire pour éditer un logement
     */
    #[Route('/adminlogements/{id}/edit', name: 'admin_logement_edit')]
    public function editlogement(Immos $immo, Request $request, EntityManagerInterface $manager):Response
    {
        $user = $this->getUser(); //récupération de l'utilisateur connecté

        $fileName = $immo->getCover();
        if(!empty($fileName)){
            $immo->setCover(new File($this->getParameter('uploads_directory').'/'.$immo->getCover()));
        }

        $form = $this->createForm(UpdateImmosType::class, $immo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {        

            $immo-> setCover($fileName);
            
            $manager->persist($immo);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le logement a bien été modifié"
            );

            return $this->redirectToRoute('admin_logement',['id'=>$immo->getId()]);
           
        }

        return $this->render("admin/editImmo.html.twig",[
            "immo"=>$immo,
            "myform"=>$form->createView()
        ]);

    }

    
    #[Route("/adminlogements/{id}/delete", name:"admin_logements_delete")]
    public function delete(Immos $immo, EntityManagerInterface $manager): Response
    {
        $this->addFlash(
            'success',
            "Le logement {$immo->getTitre()}</strong> a bien été supprimé"
        );

        unlink($this->getParameter('uploads_directory').'/'.$immo->getCover());

        $images = $immo->getImages();
        if($images){
            foreach($images as $image){
                unlink($this->getParameter('uploads_directory').'/'.$image->getFile());

                $manager->remove($image);
                $manager->flush();
            }
        }

        $manager->remove($immo);
        $manager->flush();

        return $this->redirectToRoute('admin_logement');
    }

     /**
     * Permet de modifier l'image du motif
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route("/adminlogements/{id}/imgmodify", name:"admin_logement_img")]
    public function imgModify(Immos $immo, Request $request, EntityManagerInterface $manager): Response
    {
        $imgModify = new ImmoImgModify();
        $form = $this->createForm(ImmoImgModifyType::class, $imgModify);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // supprimer l'image dans le dossier
            if(!empty($immo->getCover()))
            {
                unlink($this->getParameter('uploads_directory').'/'.$immo->getCover());
            }

            $file = $form['newCover']->getData();
            if(!empty($file))
            {
                $originalFilename = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin;Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename."-".uniqid().".".$file->guessExtension();
                try{
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                }catch(FileException $e)
                {
                    return $e->getMessage();
                }
                $immo->setCover($newFilename);
            }

            $manager->persist($immo);
            $manager->flush();

            $this->addFlash(
                'success',
                'L\'image de couverture du logement a bien été modifiée'
            );

            return $this->redirectToRoute('admin_logement', [
                
            ]);

        }

        return $this->render("admin/imgModify.html.twig",[
            'myform' => $form->createView(),
            'immo'=>$immo
        ]);
    }



    /**
     * Permet d'afficher le formulaire pour éditer un logement
     */
    #[Route('/adminfaq/{id}/edit', name: 'admin_faq_edit')]
    public function editFaq(Faq $faq, Request $request, EntityManagerInterface $manager):Response
    {
       
        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {        
            
            $manager->persist($faq);
            $manager->flush();

            $this->addFlash(
                'success',
                "La question a bien été modifiée"
            );

            return $this->redirectToRoute('admin_faq');
           
        }

        return $this->render("admin/addFaq.html.twig",[
            "myform"=>$form->createView()
        ]);

    }

    #[Route("/adminfaq/{id}/delete", name:"admin_faq_delete")]
    public function faqdelete(Faq $faq, EntityManagerInterface $manager): Response
    {
        $this->addFlash(
            'success',
            "La question {$faq->getId()}</strong> a bien été supprimé"
        );

        $manager->remove($faq);
        $manager->flush();

        return $this->redirectToRoute('admin_faq');
    }

    /**
     * Permet d'afficher le formulaire pour éditer un logement
     */
    #[Route('/adminactivities/{id}/edit', name: 'admin_activities_edit')]
    public function editActivity(Activities $activity, Request $request, EntityManagerInterface $manager):Response
    {
        $fileName = $activity->getImage();
        if(!empty($fileName)){
            $activity->setImage(new File($this->getParameter('uploads_directory').'/'.$activity->getImage()));
        }

        $form = $this->createForm(UpdateActivityType::class, $activity);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {        

            $activity-> setImage($fileName);
            
            $manager->persist($activity);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'activité {{activity.title}} a bien été modifié"
            );

            return $this->redirectToRoute('admin_activities',['id'=>$activity->getId()]);
           
        }

        return $this->render("admin/addActivities.html.twig",[
            "activity"=>$activity,
            "myform"=>$form->createView()
        ]);

    }

    /**
     * Permet de modifier l'image de l'activité
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route("/adminactivity/{id}/imgmodify", name:"admin_activity_img")]
    public function imgActivityModify(Activities $activity, Request $request, EntityManagerInterface $manager): Response
    {
        $imgModify = new ActivityImgModify();
        $form = $this->createForm(ActivityImgModifyType::class, $imgModify);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // supprimer l'image dans le dossier
            if(!empty($activity->getImage()))
            {
                unlink($this->getParameter('uploads_directory').'/'.$activity->getImage());
            }

            $file = $form['newImage']->getData();
            if(!empty($file))
            {
                $originalFilename = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
                $safeFilename = transliterator_transliterate('Any-Latin;Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename."-".uniqid().".".$file->guessExtension();
                try{
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                }catch(FileException $e)
                {
                    return $e->getMessage();
                }
                $activity->setImage($newFilename);
            }

            $manager->persist($activity);
            $manager->flush();

            $this->addFlash(
                'success',
                'L\'image de couverture de l\'activité a bien été modifiée'
            );

            return $this->redirectToRoute('admin_activities', [
                
            ]);

        }

        return $this->render("admin/imgActivityModify.html.twig",[
            'myform' => $form->createView(),
            'activity'=>$activity
        ]);
    }

    #[Route("/adminactivities/{id}/delete", name:"admin_activities_delete")]
    public function activitiesdelete(Activities $activity, EntityManagerInterface $manager): Response
    {
        $this->addFlash(
            'success',
            "L'activité {$activity->getTitre()}</strong> a bien été supprimée"
        );

        unlink($this->getParameter('uploads_directory').'/'.$activity->getImage());

        $manager->remove($activity);
        $manager->flush();

        return $this->redirectToRoute('admin_activities');
    }
}
