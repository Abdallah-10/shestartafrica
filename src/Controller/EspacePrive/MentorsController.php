<?php

namespace App\Controller\EspacePrive;

use App\Entity\Available;
use App\Form\AvailableType;
use App\Repository\AvailableRepository;
use App\Repository\MentorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

class MentorsController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/espace/prive/mentors", name="app_espace_prive_mentors")
     */
    public function index(MentorRepository $mentorRepository): Response
    {
        $mentors = $mentorRepository->findAll();
     
        return $this->render('espace_prive/mentors/index.html.twig', [
            'mentors' => $mentors,
            
        ]);
    }

     /**
      * @IsGranted("ROLE_USER")  
      * @Route("/espace/prive/mentors/{slug}", name="app_espace_prive_mentor_detail")
     */
    public function show(MentorRepository $mentorRepository,string $slug,Request $request,AvailableRepository $availableRepository): Response
    {

        $mentor = $mentorRepository->findOneBy(['slug'=>$slug]);
        $available = new Available();
        $form = $this->createForm(AvailableType::class, $available);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $available->setUser($user);
            $available->setDateAdd(new \DateTime());
            $availableRepository->add($available, true);
        }
        return $this->render('espace_prive/mentors/detail.html.twig', [
            'mentor' => $mentor,
            'form' => $form->createView(),
        ]);
    }
}
