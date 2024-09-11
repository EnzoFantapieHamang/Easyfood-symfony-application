<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IndexClientController extends AbstractController
 {
    #[Route("/index/client", name:"index_client")]
     public function index()
     {
        
        return $this->render('client/index.html.twig', [
            'message' => "Bienvenue sur la page des clients.",
        ]); // $this->render() retourne un objet Response
     }
     
   
}