<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Resto;
use App\Form\PlatType;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

#[Route('/plat')]
class PlatController extends AbstractController
{
    #[Route('/', name: 'app_plat_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $plats = $entityManager
                ->getRepository(Plat::class)
                ->findAll();
        
        return $this->render('plat/index.html.twig', [
            'plats' => $plats,
        ]);
    }
    
   #[Route('/mes-plats', name: 'app_plat_mes_plats', methods: ['GET'])]
public function mesPlats(EntityManagerInterface $entityManager, Request $request): Response
{
    // Supposons que le restaurateur connecté est récupéré via la méthode getUser()
    $user = $this->getUser();

    if ($user === null) {
        return $this->json(['error' => 'Restaurateur not found or not authenticated'], Response::HTTP_FORBIDDEN);
    }

    // Récupérer les restaurants du restaurateur connecté
    $restos = $user->getLesRestos();

    // Initialiser un tableau pour contenir tous les plats
    $allPlats = [];

    // Récupérer les plats des restaurants du restaurateur
    foreach ($restos as $resto) {
        $plats = $resto->getLesPlats();
        foreach ($plats as $plat) {
            $allPlats[] = $plat;
        }
    }

    return $this->render('plat/show.html.twig', [
        'plats' => $allPlats, // Passer la liste de plats
    ]);
}

    
    

    #[Route('/new', name: 'app_plat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('app_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plat/new.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plat_show', methods: ['GET'])]
    public function show(Plat $plat): Response
    {
        return $this->render('plat/show.html.twig', [
            'plat' => $plat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plat $plat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('index_restaurateur', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plat/edit.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plat_delete', methods: ['POST'])]
    public function delete(Request $request, Plat $plat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($plat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index_restaurateur', [], Response::HTTP_SEE_OTHER);
    }
    
    /*#[Route("/recherche/{id}", name: "recherche_plat_by_idu")]
	public function rechercheP(EntityManagerInterface $entityManager, Plat $plat) {
   	 $lesPlats = new ArrayCollection();
        
                $plat = $plat->getId();
        	$lesPlats = $entityManager->getRepository(Plat::class)->getPlatType($plat);
   	 
    	return $this->render('plat/index.html.twig', [
        	'plats' => $lesPlats,
    	]);
	}*/

}
