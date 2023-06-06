<?php

namespace App\Controller;

use App\Entity\Expert;
use App\Entity\Investor;
use App\Entity\Mentor;
use App\Entity\Ventures;
use App\Form\ExpertsType;
use App\Form\InvestorType;
use App\Form\MentorType;
use App\Form\UserType;
use App\Form\VenturesType;
use App\Repository\AvailableRepository;
use App\Repository\InscreptionRepository;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use App\Repository\VenturesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class ProfilController extends AbstractController
{
    private $security;
    function __construct(Security $security)
    {
        $this->security = $security;
    }
  
    /**
     * @Route("espace/prive/profil", name="app_profil")
     */
    public function index(Request $request,VenturesRepository $venturesRepository, 
    AvailableRepository $availableRepository, UserRepository $userRepository,TrainingRepository $trainingRepository,
    InscreptionRepository $inscreptionRepository,EntityManagerInterface $entityManager): Response
    {
        
        $user = $this->security->getUser();
        $expert = $entityManager->getRepository(Expert::class)->findOneBy(['user'=>$user]);
        $venture = $entityManager->getRepository(Ventures::class)->findOneBy(['user'=>$user]);
        $mentor = $entityManager->getRepository(Mentor::class)->findOneBy(['user'=>$user]);
        $investor =$entityManager->getRepository(Investor::class)->findOneBy(['user'=>$user]);

        $programme = $user->getProgramme();
        
        if($programme == "expert"){
            $form = $this->createForm(ExpertsType::class, $expert);
        }elseif($programme =="venture"){
            $form = $this->createForm(VenturesType::class, $venture);
        }elseif($programme =="mentor"){
            $form = $this->createForm(MentorType::class, $mentor);
        }elseif($programme =="investor"){
            $form = $this->createForm(InvestorType::class, $investor);
        }else {
            $form = $this->createForm(UserType::class, $user);
        }
        if($programme == "expert"){
            $trainings = $trainingRepository->findBy(['trainer'=>$user->getExpert(),'status'=>'1']);
        }else {
            $trainings = $inscreptionRepository->findBy(['user'=>$user,'status'=>'1']);
        }
       
        $vent = $venturesRepository->findBy(['user'=>$user]);
        $availables = $availableRepository->findBy(['persona'=>$vent]);
        
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
        }
        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'trainings' =>$trainings,
            'availables' =>$availables,
            'form' => $form->createView(),
        ]);
    }
}
