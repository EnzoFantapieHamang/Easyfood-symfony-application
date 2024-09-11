<?php

// src/Controller/DefaultController.php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController {

    #[Route("/",name:"index_general")]
    public function index() {
        if ($this->getUser()!=null){
        
        if (in_array("ROLE_RESTAURATEUR", $this->getUser()->getRoles())) {
            return $this->redirectToRoute("index_restaurateur");
        }
        if (in_array("ROLE_CLIENT", $this->getUser()->getRoles())) {
            return $this->redirectToRoute("index_client");
        }
        if (in_array("ROLE_MODERATEUR", $this->getUser()->getRoles())) {
            return $this->redirectToRoute("index_moderateur");
        }
        if (in_array("ROLE_ADMIN", $this->getUser()->getRoles())) {
            return $this->redirectToRoute("index_admin");
        } else {
            return $this->render('default/index.html.twig', [
                        'message' => "Vous n'avez pas de rôle.",
            ]); 
        }

        
        }
        else{
            return $this->redirectToRoute("app_login");
        }
}
    }