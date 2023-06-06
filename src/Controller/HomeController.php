<?php

namespace App\Controller;

use App\Repository\TestimonialRepository;
use App\Repository\VenturesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(Request $request,VenturesRepository $venturesRepository,TestimonialRepository $testimonialRepository): Response
    {
        $ventures = $venturesRepository->findBy(['status' => 1], ['id'=>'DESC'],6, 0);
        $testimonials = $testimonialRepository->findAll();
        return $this->render('home/index.html.twig', [
            'ventures' => $ventures,
            'testimonials' => $testimonials
        ]);
    }
}
