<?php

namespace App\Controller;

use App\Repository\EventsRepository;
use App\Repository\InvestorRepository;
use App\Repository\MentorRepository;
use App\Repository\VenturesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscoverController extends AbstractController
{
    /**
     * @Route("/discover", name="app_discover")
     */
    public function index(Request $request,EventsRepository $eventsRepository,VenturesRepository $venturesRepository,
    InvestorRepository $investorRepository,MentorRepository $mentorRepository): Response
    {
        $sector = $request->request->get('sector');
        $contry = $request->request->get('country');
        
        $ventures = $venturesRepository->findBy(['status' => 1], ['id'=>'DESC']);
        $countrys = $venturesRepository->findcountry();
        $sectors = $venturesRepository->findsectors();
        
        $partners = $investorRepository->findBy(['status' => 1], ['id'=>'DESC']);
        $events = $eventsRepository->findBy(['status' => 1], ['id'=>'DESC']);
        $mentors = $mentorRepository->findBy(['status' => 1], ['id'=>'DESC']);
       
       
        if($sector || $contry ){
    
        $ventures = $venturesRepository->findOneBySomeField($sector,$contry);
       
        $response = [];
        foreach ($ventures as $venture) {
            $response[] = [
                'id' => $venture->getId(),
                'slug' => $venture->getSlug(),
                'title' => $venture->getTitle(),
                'description' => $venture->getDescription(),
                'years' => $venture->getYears(),
                'cover' => $venture->getCover(),
                'sector' => $venture->getSector(),
                'country' => $venture->getCountry(),
                'founder' => $venture->getFounder(),
            ];
        }
        
        return new JsonResponse([
            'success' => true,
            'content' => $this->renderView('ventures/_venture_list.html.twig', ['ventures' => $response])
        // return new JsonResponse($response);
        ]);
        
    }
        return $this->render('discover/index.html.twig', [
            'events' => $events,
            'ventures' =>$ventures,
            'country' =>$countrys,
            'sectors' =>$sectors,
            'partners'=>$partners,
            'mentors'=>$mentors
        ]);
    }

    /**
     * @Route("/events/{slug}", name="event_detail" , methods={"GET"})
     */
    public function show(EventsRepository $EventsRepository,string $slug): Response
    {

        $event = $EventsRepository->findOneBy(['slug'=>$slug]);
       
        return $this->render('news/detail.html.twig', [
            'events' => $event,
        ]);
    }
}
