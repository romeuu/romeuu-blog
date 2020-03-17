<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\HttpFoundation\Request as Request;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index()
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * @Route("/list/{page}", name="list")
     */
    
    public function listAction(Request $request, $page){
        
    }

    /**
     * @Route("/{slug}", name="post_view")
     */
    
    public function viewAction(Request $request, $slug){
        // $response = new Response('Hello '.$slug, Response::HTTP_OK);
        // return $response;
        
    }

    /**
     * @Route("/post/new", name="post_new")
     */
    
    public function newAction(Request $request){

    }

    /**
     * @Route("/post/edit/{slug}", name="post_edit")
     */
    
    public function editAction(Request $request, $slug){

    }
}
