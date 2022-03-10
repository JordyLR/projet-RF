<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\User;
use App\Form\CommentaireType;
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
    public function show($id, ManagerRegistry $doctrine, Request $request): Response {
        $repositoryArticle = $doctrine->getRepository(Article::class);
        $article = $repositoryArticle->find($id);

        $user = $this->getUser();

        $repositoryCommentaire = $doctrine->getRepository(Commentaire::class);
        $commentaires = $repositoryCommentaire->findBy([], ['created_at' => 'DESC']);

        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $commentaire->setArticle($article);
            $commentaire->setAuthor($user);
            $em = $doctrine->getManager();
            $em->persist($commentaire);
            $em->flush();
            return $this->redirectToRoute('article_show', ['id' => $article->getId()]);
        }
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'commentaires' => $commentaires,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/supprimer", name="delete_commentaire", requirements={ "id" : "\d+" })
     */
    public function deleteCommentaire($id, ManagerRegistry $doctrine, Request $request): Response {
        $route = $request->headers->get('referer');
        $repositoryCommentaire = $doctrine->getRepository(Commentaire::class);
        $commentaire = $repositoryCommentaire->find($id);
        $em = $doctrine->getManager();
        $em->remove($commentaire);
        $em->flush();
        return $this->redirectToRoute('article_show', [ 'id' => $commentaire->getArticle()->getId()]);
        // $request->attributes->get('_route')
    }
    /**
     * @Route("/{id}/editer", name="edit_commentaire", requirements={ "id" : "\d+" })
     */
    public function edit($id, ManagerRegistry $doctrine, Request $request): Response {
        $repository = $doctrine->getRepository(Commentaire::class);
        $commentaire = $repository->find($id);
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('article_show', [ 'id' => $commentaire->getArticle()->getId()]);
        }
        return $this->render('commentaire/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
