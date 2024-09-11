<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
    
    

   #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
{
    // Create the form using the user object
    $form = $this->createFormBuilder($user)
        ->add('email', TextType::class, ['required' => true])
        ->add('password', TextType::class, ['required' => true])
        ->add('numAdrR', TextType::class, ['required' => true])
        ->add('rueAdrR', TextType::class, ['required' => true])
        ->add('cpR', TextType::class, ['required' => true])
        ->add('villeR', TextType::class, ['required' => true])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Get the user entity from the form
        $user = $form->getData();

        // If the password has been modified, hash it before saving
        $password = $form->get('password')->getData();

        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $user->setPassword($hashedPassword);
        }

        // Persist the changes to the database
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('user/edit.html.twig', [
        'user' => $user,
        'form' => $form->createView(),
    ]);
}
    
    
    

    #[Route('/delete/{id}', name: 'app_user_delete', methods: ['GET','POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
        {
    // Vérifie si le jeton CSRF est valide
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_register', [], Response::HTTP_SEE_OTHER);
        }

    // Si le jeton CSRF n'est pas valide, affiche une erreur ou redirige l'utilisateur
        return $this->redirectToRoute('app_user_show', ['id' => $user->getId()]);
    }  

}
