<?php

namespace App\Controller;

use App\Entity\Equipe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="equipe_index")
     */
    public function index(ManagerRegistry $doctrine): Response
    {   
        $equipeRepository = $doctrine->getRepository(Equipe::class);
        $equipe = $equipeRepository->findAll();
        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipe,
        ]);
    }
}
