<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Equipe;
use App\Entity\Planning;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $planningRepository = $doctrine->getRepository(Planning::class);
        $planning = $planningRepository->findNext();
        $articleRepository = $doctrine->getRepository(Article::class);
        $article = $articleRepository->findBy([], ['created_at' => 'DESC'], 4);
        return $this->render('app/index.html.twig', [
            'plannings' => $planning,
            'articles' => $article
        ]);
    }
}
