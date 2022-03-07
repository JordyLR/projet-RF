<?php

namespace App\Controller;

use App\Entity\Equipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/equipe")
 */

class EquipeController extends AbstractController
{
    /**
     * @Route("/", name="equipe_index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {   
        $equipeRepository = $doctrine->getRepository(Equipe::class);
        $equipe = $equipeRepository->findAll();
        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipe,
        ]);
    }

    /**
     * @Route("/show/{id}", name="equipe_show", requirements={ "id" : "\d+" })
     */
    public function show($id, ManagerRegistry $doctrine): Response {
        $repositoryEquipe = $doctrine->getRepository(Equipe::class);
        $equipe = $repositoryEquipe->find($id);
        return $this->render('equipe/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }
}
