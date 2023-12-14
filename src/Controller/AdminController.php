<?php

namespace App\Controller;

use App\Entity\Immos;
use App\Form\ImmosType;
use App\Security\UserChecker;
use App\Repository\FaqRepository;
use App\Repository\UserRepository;
use App\Repository\ImmosRepository;
use App\Repository\ActivitiesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

            $manager->persist($immo);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le logement {$immo->getTitre()} a bien été ajouté"
            );
        }
    
        return $this->render("admin/addlogement.html.twig",[
            'myform'=>$form->createView()
        ]);
    } 
    


}
