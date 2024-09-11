<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IndexAdminController extends AbstractController
 {
    #[Route("/index/admin", name:"index_admin")]
     public function index()
     {
        
        return $this->render('admin/index.html.twig', [
            'message' => "Bienvenue sur la page des admins.",
        ]); // $this->render() retourne un objet Response
     }
     
   
}