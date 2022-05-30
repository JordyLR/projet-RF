<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createFormBuilder()
            ->add('entreprise', TextType::class)
            ->add('mail', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Envoyer'])
            ->getForm();;
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            
            $message = (new Email())
                ->from($contactFormData['mail'])
                ->to('exemple@campusdulac.com')
                ->subject('Vous avez reçu un email via le formulaire de contact du site')
                ->text('Envoyé par : '.$contactFormData['entreprise'].\PHP_EOL.
                    $contactFormData['message']);
            $mailer->send($message);
            $this->addFlash('succes', 'Votre message a été envoyé');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
