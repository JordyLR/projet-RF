<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PasswordChangeType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function index(ManagerRegistry $doctrine): Response
    {   

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/profil/", name="user_edit")
     */
    public function edit(ManagerRegistry $doctrine, Request $request, UserRepository $userRepository): Response {
        
        $user = $userRepository->find($this->getUser());
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            $this->addFlash('notice', 'Votre profil a bien été modifié');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/profil/editpass", name="user_password_edit", methods={"GET", "POST"})
     */
    public function editPassword(Request $request, ManagerRegistry $doctrine, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $userRepository->find($this->getUser());
        $form = $this->createForm(PasswordChangeType::class, $user);
        $form->handleRequest($request);
        // on protège le profil de chaque user, seul le propriétaire y a accès
        if ($this->getUser()!=$user){
            $this->addFlash('notice', 'Vous ne pouvez pas accéder à cette ressource');
            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            //mot de passe actuel
            $plainPassword = $form->get('ActualPassword')->getData();
            //verification mdp actuel
            if (password_verify($plainPassword, $user->getPassword())) {
                //si ok changement de mot de passe
                if ($form->get('password')->getData() === $form->get('password2')->getData()) {
                    //changement de mot de passe
                    $user->setPassword(
                        $userPasswordHasher->hashPassword(
                            $user,
                            $form->get('password')->getData()
                        )
                    );
                    $em= $doctrine->getManager();
                    $em->persist($user);
                    $em->flush();

                    $this->addFlash('notice', 'Votre mot de passe a été modifié');
                    return $this->redirectToRoute('app_index', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
                    //mauvais mdp nouveau
                } else {
                    $this->addFlash('notice', 'les champs: "nouveau mot de passe" et "confirmation" doivent être identiques');
                    return $this->redirectToRoute('user_password_edit', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
                }
            }else {
                $this->addFlash('notice', 'Votre mot de passe actuel n\'est pas valable');
                return $this->redirectToRoute('user_password_edit', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('user/password-edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
