<?php

namespace App\Controller;

use App\Entity\TypePlat;
use App\Form\TypePlatType;
use App\Repository\TypePlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/plat')]
class TypePlatController extends AbstractController
{
    #[Route('/', name: 'app_type_plat_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $typesPlats = $entityManager
                ->getRepository(TypePlat::class)
                ->findAll();
        
        return $this->render('type_plat/index.html.twig', [
            'type_plats' => $typesPlats,
        ]);
    }

    #[Route('/new', name: 'app_type_plat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typePlat = new TypePlat();
        $form = $this->createForm(TypePlatType::class, $typePlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typePlat);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_plat/new.html.twig', [
            'type_plat' => $typePlat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_plat_show', methods: ['GET'])]
    public function show(TypePlat $typePlat): Response
    {
        return $this->render('type_plat/show.html.twig', [
            'type_plat' => $typePlat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_plat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypePlat $typePlat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypePlatType::class, $typePlat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_plat/edit.html.twig', [
            'type_plat' => $typePlat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_plat_delete', methods: ['POST'])]
    public function delete(Request $request, TypePlat $typePlat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typePlat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typePlat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_plat_index', [], Response::HTTP_SEE_OTHER);
    }
}
