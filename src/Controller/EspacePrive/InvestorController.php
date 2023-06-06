<?php

namespace App\Controller\EspacePrive;

use App\Repository\InvestorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class InvestorController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/espace/prive/investor", name="app_espace_prive_investor")
     */
    public function index(InvestorRepository $investorRepository): Response
    {
        $investors = $investorRepository->findBy(['status' => 1], ['id'=>'DESC']);

        return $this->render('espace_prive/investor/index.html.twig', [
            'investors' => $investors,
        ]);
    }
}
