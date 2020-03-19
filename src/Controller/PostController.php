<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use Symfony\Component\HttpFoundation\Request as Request;

use App\Entity\BlogPost;

$request = Request::createFromGlobals();


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
     * @Route("/post/list/{page}", name="list")
     */
    
    public function listAction(Request $request, $page){
        $postRespository = $this->getDoctrine()
        ->getRepository('App:BlogPost');

        $posts = $postRespository->findAll();

        // Change so the user can see the complete list.
        return new Response('List ' . $posts);
    }

    /**
     * @Route("/post/search/{title}", name="search")
     */
    
    public function searchAction(Request $request, $title){

        $postRespository = $this->getDoctrine()
        ->getRepository('App:BlogPost');

        $posts = $postRespository->findAllByTitle($title);
        return new JsonResponse($posts);
    }

    

    /**
     * @Route("/post/new", name="post_new")
     */
    
    public function newAction(Request $request){
        // Replace with form so the user can input data and create a post.

        $post = new BlogPost();
        $post->setTitle('Starting out with Symfony 5');
        $post->setSlug('starting-out-symfony5');
        $post->setDescription('A brief post about your first steps in the Symfony world.');

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Created post with title ' . $post->getTitle());
    }

    /**
     * @Route("/post/{id}", name="post_view")
     */
    
    public function viewAction(Request $request, $id){
        $postRespository = $this->getDoctrine()
        ->getRepository('App:BlogPost');

        $post = $postRespository->find($id);

        return new Response('Post with title ' . $post->getTitle());
    }

    /**
     * @Route("/post/edit/{id}", name="post_edit")
     */
    
    public function editAction(Request $request, $id){
        
    }
}
