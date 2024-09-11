<?php

namespace App\Controller;

use App\Entity\Quantite;
use App\Form\QuantiteType;
use App\Repository\QuantiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/quantite')]
class QuantiteController extends AbstractController
{
    #[Route('/', name: 'app_quantite_index', methods: ['GET'])]
    public function index(QuantiteRepository $quantiteRepository): Response
    {
        return $this->render('quantite/index.html.twig', [
            'quantites' => $quantiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quantite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quantite = new Quantite();
        $form = $this->createForm(QuantiteType::class, $quantite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quantite);
            $entityManager->flush();

            return $this->redirectToRoute('app_quantite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quantite/new.html.twig', [
            'quantite' => $quantite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quantite_show', methods: ['GET'])]
    public function show(Quantite $quantite): Response
    {
        return $this->render('quantite/show.html.twig', [
            'quantite' => $quantite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quantite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quantite $quantite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuantiteType::class, $quantite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quantite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quantite/edit.html.twig', [
            'quantite' => $quantite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quantite_delete', methods: ['POST'])]
    public function delete(Request $request, Quantite $quantite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quantite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quantite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quantite_index', [], Response::HTTP_SEE_OTHER);
    }
}
