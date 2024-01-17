<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function index(BlogRepository $repo): Response
    {
        $blogs = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }

    #[Route('/blog/{id}', name:"showarticle")]
    public function showArticle (int $id, Blog $blog ):Response
    {
        return $this->render('blog/article.html.twig', [
            'blog' => $blog,
        ]);
    }
}
