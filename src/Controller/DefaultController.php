<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    
    public function index(Request $request){
        return $this->render('/layout.html.twig', [
            'controller_name' => 'DefaultController',
        ]);

    }
}
?>