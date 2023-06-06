<?php

namespace App\Controller;

use App\Entity\Expert;
use App\Entity\Investor;
use App\Entity\Mentor;
use App\Entity\Training;
use App\Entity\User;
use App\Entity\Ventures;
use App\Form\Expert1Type;
use App\Form\ExpertsType;
use App\Form\ExpertType;
use App\Form\InvestorType;
use App\Form\Mentor1Type;
use App\Form\MentorType;
use App\Form\MontorType;
use App\Form\RegistrationFormType;
use App\Form\TeamType;
use App\Form\VenturesType;
use App\Repository\UserRepository;
use App\Security\AppCustomAuthenticator;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('a.salah@numeryx.fr', 'SST Mail Bot'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email
            $hashedId = hash('sha256', $user->getId());

                return $this->redirectToRoute('personal_info', [
                    'id' => $user->getId(),
                    'hashedId' => $hashedId,
                ]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
     /**
     * @Route("/personal-info/{id}/{hashedId}", name="personal_info")
     */
    public function personalInfo(Request $request,ManagerRegistry $doctrine, $id ,SluggerInterface $slugger): Response
    {

        $hashedId = hash('sha256', $id);
        $idh = $request->get('hashedId');
       
        $venture = New Ventures();
        $investor = New Investor();
        $mentor = New Mentor();
        $expert = New Expert();

        if(hash_equals($hashedId, $idh)) {
           
            $entityManager = $doctrine->getManager();
            $user = $entityManager->getRepository(User::class)->find($id);
            $program = $user->getProgramme();
            
            if($program == "venture"){
                $form = $this->createForm(VenturesType::class,$venture);
            
                $form->handleRequest($request);
            
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
                    return $this->redirectToRoute('app_home');
                }
            }
            elseif($program == "investor"){
                $form = $this->createForm(InvestorType::class,$investor);
                $form->handleRequest($request);
            
                if ($form->isSubmitted() && $form->isValid()) {
                    $file = $form->get('logo')->getData();
                
                    if ($file) {
                        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        // this is needed to safely include the file name as part of the URL
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
    
                        // Move the file to the directory where brochures are stored
                        try {
                            $file->move(
                                $this->getParameter('uploads_directory_experts'),
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }
    
                        $investor->setLogo($newFilename);
                    
                    }
                    // Save the user's personal information
                   
                    $slug = $slugger->slug($investor->getTitle().'-'. $investor->getId());
                    $investor->setSlug($slug);
                    $investor->setDateAdd(new \DateTime());
                    $entityManager->persist($investor);
                    $entityManager->flush();
                    // Redirect to a success page or the homepage
                    return $this->redirectToRoute('app_home');
                }
            
            }
            elseif($program == "expert"){
            
                $form = $this->createForm(ExpertsType::class, $expert);
                $form->handleRequest($request);
        
                
                if ($form->isSubmitted() && $form->isValid()) {
                    $file = $form->get('picture')->getData();
                
                    if ($file) {
                        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        // this is needed to safely include the file name as part of the URL
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
    
                        // Move the file to the directory where brochures are stored
                        try {
                            $file->move(
                                $this->getParameter('uploads_directory_investor'),
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }
    
                        $expert->setPicture($newFilename);
                    
                    }
                    $expert->setEmail($user->getEmail());
                    $expert->setUser($user);
                    $expert->setDateAdd(new \DateTime());
                    // Save the user's personal information
                    $slug = $slugger->slug($expert->getFirstname().'-'. $expert->getId());
                    $expert->setSlug($slug);
                    $entityManager->persist($expert);
                    $entityManager->flush();
                    // Redirect to a success page or the homepage
                    return $this->redirectToRoute('app_home');
                }
            }
            else{
                $mentor = new Mentor();
                $form = $this->createForm(MentorType::class, $mentor);
                $form->handleRequest($request);            
                if ($form->isSubmitted() && $form->isValid()) {
                    $file = $form->get('cover')->getData();
                
                    if ($file) {
                        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        // this is needed to safely include the file name as part of the URL
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
    
                        // Move the file to the directory where brochures are stored
                        try {
                            $file->move(
                                $this->getParameter('uploads_directory_investor'),
                                $newFilename
                            );
                        } catch (FileException $e) {
                            // ... handle exception if something happens during file upload
                        }
    
                        $mentor->setCover($newFilename);
                    
                    }
                    $mentor->setMail($user->getEmail());
                    $mentor->setUser($user);
                    // Save the user's personal information
                    $slug = $slugger->slug($mentor->getName().'-'. $mentor->getId());
                    $mentor->setSlug($slug);
                    $mentor->setDateAdd(new \DateTime());
                    $entityManager->persist($mentor);
                    $entityManager->flush();
                    // Redirect to a success page or the homepage
                    return $this->redirectToRoute('app_home');
                }
            }
            

           
         } else {
            return $this->redirectToRoute('app_login');
        } 
        
        return $this->render('registration/info.html.twig', [
            'form' => $form->createView(),
            'user'=>$user,
            'program'=>$program,
        ]);
    }
}
