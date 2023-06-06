<?php

namespace App\Controller\EspacePrive;

use App\Entity\Attendance;
use App\Entity\Inscreption;
use App\Form\AttendanceType;
use App\Form\InscreptionType;
use App\Repository\AttendanceRepository;
use App\Repository\InscreptionRepository;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class trainingController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/espace/prive/training", name="app_espace_prive_training")
     */
    public function index(TrainingRepository $trainingRepository): Response
    {
        $trinings = $trainingRepository->findAll();
        $category = $trainingRepository->findAllCategory();
        
        $data=[];
        foreach($category as $key=>$type){
            if(!empty($type['category'])){
                array_push($data,$type['category']);
            }
           }
       
        return $this->render('espace_prive/training/index.html.twig', [
            'trainings' => $trinings,
            'category' => $data,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/espace/prive/training/{slug}", name="app_espace_prive_training_detail")
     */
    public function show(TrainingRepository $trainingRepository,AttendanceRepository $attendanceRepository,InscreptionRepository $inscreptionRepository,string $slug,Request $request): Response
    {

        $inscreption = new Inscreption();
        $user = $this->getUser();
        $training = $trainingRepository->findOneBy(['slug'=>$slug]);
        $courses = $inscreptionRepository->findBy(['training'=>$training ,'status' => '1']);
        $attendances = $attendanceRepository->findBy(['training'=>$training,]);
        if($courses && !$attendances){
            
            foreach($courses as $course){
               
                $attendance = new Attendance();
                $attendance->setUsername($course->getUser()->getFirstname());
                $attendance->setUserlastname($course->getUser()->getLastname());
                $attendance->setUseremail($course->getUser()->getEmail());
                $attendance->setPosition($course->getUser()->getProgramme());

                $attendance->setTraining($training);
                $attendanceRepository->add($attendance, true);
    
            }
        }
       
        $attendance = new Attendance();
        $formc = $this->createForm(AttendanceType::class, $attendance);
        $formc->handleRequest($request);

        $form = $this->createForm(InscreptionType::class,$inscreption);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
           
            $inscreption->setUser($user);
            $inscreption->setTraining($training);
            $inscreption->setDateAdd(new \DateTime());
            $inscreptionRepository->add($inscreption, true);
        }
        return $this->render('espace_prive/training/detail.html.twig', [
            'training' => $training,
            'courses' => $courses,
            'user' => $user,
            'attendances'=>$attendances,
            'form' => $form->createView(),
            'formc' => $formc->createView(),
        ]);
    }

     /**
     * @Route("#", name="ajax_insert")
     */

    public function insert(Request $request): Response
    {
        // Récupérer les données du formulaire envoyées via AJAX
        $formData = $request->request->get('form');
       
        dd(explode('&',$formData));



        // Retourner une réponse JSON avec un message de succès
        return new JsonResponse(['success' => true, 'message' => 'Données insérées avec succès']);
    }

}
