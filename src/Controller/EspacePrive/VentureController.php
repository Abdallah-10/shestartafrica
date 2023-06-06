<?php

namespace App\Controller\EspacePrive;

use App\Entity\Available;
use App\Entity\Ventures;
use App\Form\AvailableType;
use App\Form\VenturesType;
use App\Repository\AvailableRepository;
use App\Repository\VenturesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class VentureController extends AbstractController
{
    private $security;
    function __construct(Security $security)
    {
        $this->security = $security;
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/espace/prive/venture", name="app_espace_prive_venture")
     */
    public function index(VenturesRepository $venturesRepository): Response
    {
        $countrys = $venturesRepository->findcountry();
        $sectors = $venturesRepository->findsectors();

        $ventures = $venturesRepository->findBy(['status' => 1], ['id'=>'DESC']);
        return $this->render('espace_prive/venture/index.html.twig', [
            'ventures' => $ventures,
            'country' => $countrys,
            'sectors' => $sectors,
        ]);
    }
     /**
      * @IsGranted("ROLE_USER")
      * @Route("/espace/prive/venture/{slug}", name="app_espace_prive_venture_detail" )
     */
    public function show(VenturesRepository $venturesRepository,Request $request,AvailableRepository $availableRepository, string $slug): Response
    {

        $venture = $venturesRepository->findOneBy(['slug'=>$slug]);
        $available = new Available();
        $form = $this->createForm(AvailableType::class, $available);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $available->setUser($user);
            $available->setPersona($venture);
            $available->setDateAdd(new \DateTime());
            $availableRepository->add($available, true);
        }
        return $this->render('espace_prive/venture/detail.html.twig', [
            'venture' => $venture,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/espace/prive/add", name="app_espace_prive_venture_new" )
     */

    public function new(Request $request, SluggerInterface $slugger,ManagerRegistry $doctrine, VenturesRepository $venturesRepository): Response
    {
        
        $venture = new Ventures();
        $form = $this->createForm(VenturesType::class, $venture);
        $form->handleRequest($request);
        $user = $this->security->getUser();
        $entityManager = $doctrine->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('cover')->getData();
            $logo = $form->get('flag')->getData();
            if ($logo) {
                $originalFilename = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $logo->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $venture->setFlag($newFilename);
            
            }
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $venture->setCover($newFilename);
            
            }
            // Save the user's personal information
            $venture->setMail($user->getEmail());
            $venture->setUser($user);
            $slug = $slugger->slug($venture->getTitle().'-'. $venture->getId());
            $venture->setSlug($slug);
            $entityManager->persist($venture);
            $entityManager->flush();
            // Redirect to a success page or the homepage
            
        }

        return $this->renderForm('espace_prive/venture/new.html.twig', [
            'venture' => $venture,
            'form' => $form,
        ]);
    }

}
