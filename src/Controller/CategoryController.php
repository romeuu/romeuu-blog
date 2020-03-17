<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\HttpFoundation\Request as Request;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

     /**
     * @Route("/category/{page}", name="category", requirements={"page":"\d+"})
     */
    
    public function listAction(Request $request, $page){
        
    }

     /**
     * @Route("/category/new", name="category_new")
     */
    
    public function newAction(Request $request){

    }

    /**
     * @Route("/category/edit/{slug}", name="category_edit")
     */
    
    public function editAction(Request $request, $slug){
        return new Response('Category '.$slug. '!');
    }
}
