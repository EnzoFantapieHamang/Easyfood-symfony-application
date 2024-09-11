<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IndexRestaurateurController extends AbstractController
 {
    #[Route("/index/restaurateur", name:"index_restaurateur")]
     public function index()
     {
        
        return $this->render('restaurateur/index.html.twig', [
            'message' => "Bienvenue sur la page des restaurateurs.",
        ]); // $this->render() retourne un objet Response
     }
     
   
}