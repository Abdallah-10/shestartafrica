<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact",  methods={"GET", "POST"})
     */
    public function index(Request $request ,ContactRepository $contactRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->add($contact, true);
            $this->addFlash('success', 'Thank you! Your message has been sent');
            return $this->redirectToRoute('app_contact', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
