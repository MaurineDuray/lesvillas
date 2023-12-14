<?php

namespace App\Controller;

use App\Repository\ActivitiesRepository;
use App\Repository\FaqRepository;
use App\Repository\ImmosRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Security\UserChecker;

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

    #[Route('/adminauser', name: 'admin_user')]
    public function adminUser(UserRepository $repo):Response
    {
        $users = $repo->findAll();
        return $this->render('admin/users.html.twig', [
            'users' => $users,
        ]);
    } 
    

}
