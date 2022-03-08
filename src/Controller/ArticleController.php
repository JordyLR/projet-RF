<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index")
     */
    public function index(Request $request, ManagerRegistry $doctrine, PaginatorInterface $paginator): Response
    {
        $repository = $doctrine->getRepository(Article::class);
        $article = $repository->findBy([], ['created_at' => 'DESC']);
        $article = $paginator->paginate(
            $article, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
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
