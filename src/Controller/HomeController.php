<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
        public function index(): Response
        {
            $title = "Blog posts";        
            $posts = $this->getDoctrine()
                    ->getRepository(BlogPost::class)
                    ->findAll();
            return $this->render('/home/index.html.twig',['title'=>$title,'posts'=>$posts]);
        }
}
