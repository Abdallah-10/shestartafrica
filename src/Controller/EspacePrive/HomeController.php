<?php

namespace App\Controller\EspacePrive;

use App\Repository\InvestorRepository;
use App\Repository\MentorRepository;
use App\Repository\TrainingRepository;
use App\Repository\VenturesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomeController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/espace/prive/home", name="app_espace_prive_home")
     */
    public function index(TrainingRepository $trainingRepository,VenturesRepository $venturesRepository,
    InvestorRepository $investorRepository,MentorRepository $mentorRepository): Response
    {
        $ventures = $venturesRepository->findBy(['status' => 1], ['id'=>'DESC'],6, 0);
        $trainings = $trainingRepository->findBy(['status' => 1], ['id'=>'DESC'],3, 0);
       
        $investors = $investorRepository->findBy(['status' => 1], ['id'=>'DESC'],3, 0);
        $mentors = $mentorRepository->findBy(['status' => 1], ['id'=>'DESC'],3, 0);
        return $this->render('espace_prive/home/index.html.twig', [
            'ventures' => $ventures,
            'trainings' => $trainings,
            'investors' => $investors,
            'mentors' => $mentors,
        ]);
    }
}
