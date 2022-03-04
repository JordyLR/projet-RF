<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article_index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Article::class);
        $article = $repository->findBy([], ['created_at' => 'DESC']);
        return $this->render('article/index.html.twig', [
            'articles' => $article,
        ]);
    }

    /**
     * @Route("/show/{id}", name="article_show", requirements={ "id" : "\d+" })
     */
    public function show($id, ManagerRegistry $doctrine): Response {
        $repository = $doctrine->getRepository(Article::class);
        $article = $repository->find($id);
        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }
}
