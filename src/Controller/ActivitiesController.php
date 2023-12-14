<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Repository\ActivitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivitiesController extends AbstractController
{
    #[Route('/activities', name: 'activities')]
    public function index(ActivitiesRepository $repo): Response
    {
        $activities = $repo->findAll();
        return $this->render('activities/index.html.twig', [
            'activities' => $activities,
        ]);
    }

    #[Route('/activities/azur', name: 'azur_activities')]
    public function azurActivities(ActivitiesRepository $repo):Response
    {
        $activities = $repo->findByLocalisation("Azur");
        return $this->render('activities/index.html.twig', [
            'activities' => $activities,
        ]);
    }

    #[Route('/activities/floride', name: 'floride_activities')]
    public function florideActivities(ActivitiesRepository $repo):Response
    {
        $activities = $repo->findByLocalisation("Floride");
        return $this->render('activities/index.html.twig', [
            'activities' => $activities,
        ]);
    }
}
