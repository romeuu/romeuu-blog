<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use App\Entity\BlogPost;
use App\Form\AppBlogPostType;

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
     * @Route("/post/list/", name="list")
     */
    
    public function listAction(Request $request){
        $postRespository = $this->getDoctrine()
        ->getRepository('App:BlogPost');

        $posts = $postRespository->findAll();

        // Change so the user can see the complete list.
        return $this->render('post/list.html.twig', array(
            'posts'=>$posts
        ));
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
    
    public function newAction(Request $request, ValidatorInterface $validator){
        // Replace with form so the user can input data and create a post.

        $post = new BlogPost();

        $form = $this->createForm(AppBlogPostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $post = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            
            $this->addFlash(
                'success',
                'The post has been created!'
            );

            return $this->redirectToRoute('list');
        }

        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
        ]);

        // return new Response('Created post with title ' . $post->getTitle());
    }

    /**
     * @Route("/post/{id}", name="post_view")
     */
    
    public function viewAction(Request $request, $id){
        $postRespository = $this->getDoctrine()
        ->getRepository('App:BlogPost');

        $post = $postRespository->findPost($id);

        if(count($post)>0){
            $foundPost = $post[0];
        }

        return new Response('Post with title ' . $foundPost['title']);
    }

    /**
     * @Route("/post/edit/{id}", name="post_edit")
     */
    
    public function editAction(Request $request, $id){
        $postRespository = $this->getDoctrine()
        ->getRepository('App:BlogPost');

        $post = $postRespository->findPost($id);
        
        if(count($post)>0){
            $foundPost = $post[0];
        }

        $form = $this->createForm(AppBlogPostType::class, $foundPost);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $postarray = $form->getData();

            $em = $this->getDoctrine()->getManager();
            
            $post = new BlogPost();
            $post->setTitle($postarray['title']);
            $post->setSlug($postarray['slug']);
            $post->setDescription($postarray['description']);

            // $post = $em->merge($post);
            // $em->persist($post);
            // $em->flush();

            $postRespository->updatePost($id, $post);

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('list');
        }

        return $this->render('post/edit.html.twig', [
            'posts' => $post,
            'form' => $form->createView()
        ]);
    }
}
