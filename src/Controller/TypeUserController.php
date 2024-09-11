<?php

namespace App\Controller;

use App\Entity\TypeUser;
use App\Form\TypeUserType;
use App\Repository\TypeUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/user')]
class TypeUserController extends AbstractController
{
    #[Route('/', name: 'app_type_user_index', methods: ['GET'])]
    public function index(TypeUserRepository $typeUserRepository): Response
    {
        return $this->render('type_user/index.html.twig', [
            'type_users' => $typeUserRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeUser = new TypeUser();
        $form = $this->createForm(TypeUserType::class, $typeUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_user/new.html.twig', [
            'type_user' => $typeUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_user_show', methods: ['GET'])]
    public function show(TypeUser $typeUser): Response
    {
        return $this->render('type_user/show.html.twig', [
            'type_user' => $typeUser,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeUser $typeUser, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeUserType::class, $typeUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_user/edit.html.twig', [
            'type_user' => $typeUser,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_user_delete', methods: ['POST'])]
    public function delete(Request $request, TypeUser $typeUser, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeUser->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeUser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
