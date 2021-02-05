<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function new(Request $request): Response
    {
        //creation de l'objet contact
        $contact = new Contact();

        //creation formulaire et association objet contact
        $form = $this->createForm(ContactType::class, $contact);

        //attente clique sur bouton send
        $form->handleRequest($request);

        //si les données sont correctes
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash('notice',
                'your contact were saved'
            );
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
