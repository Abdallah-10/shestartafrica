<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="app_about")
     */
    public function index(NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findBy(array(), array('id' => 'DESC'));
        if($news){
            $newsTop = $news[0];
        }else{
            $newsTop = '';
        }
        
        return $this->render('about/index.html.twig', [
            'newsTop'=>$newsTop,
            'news'=>$news,
        ]);
    }

     /**
     * @Route("/news/{slug}", name="app_news_details", methods={"GET"})
     */
    public function news(News $news,NewsRepository $newsRepository): Response
    {
        $news =  $newsRepository->findBy(['slug'=>$news->getSlug()]);

        return $this->render('news/index.html.twig', [
            'news'=>$news[0],
        ]);
    }
}
