<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IndexModerateurController extends AbstractController
 {
    #[Route("/index/moderateur", name:"index_moderateur")]
     public function index()
     {
        
        return $this->render('moderateur/index.html.twig', [
            'message' => "Bienvenue sur la page des moderateurs.",
        ]); // $this->render() retourne un objet Response
     }
     
   
}
