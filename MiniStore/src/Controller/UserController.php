<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/user/edition/{id}', name: 'app_user_edit', methods: ['GET', 'POST'])]

    public function edit(UserRepository $userRepository, int $id, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher, #[Autowire('%photo_dir%')] string $photoDir, ): Response
    {
        $user = $userRepository->findOneBy(["id" => $id]);
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())) {
                $user = $form->getData();

                if ($photo = $form['photo']->getData()) {
                    $filename = bin2hex(random_bytes(6)) . '.' . $photo->guessExtension();
                    $photo->move($photoDir, $filename);
                    $user->setImageUser($filename);
                }

                $manager->persist($user);
                $manager->flush();

                $this->addFlash('success', 'Les informations de votre compte ont bien été modifiées');

                return $this->redirectToRoute('app_home');
            } else {
                $this->addFlash('warning', 'Le mot de passe est incorrect');
            }

        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/edition-mot-de-passe/{id}', name: 'user_edit_password', methods: ['GET', 'POST'])]
    public function editPassword(UserRepository $userRepository, int $id, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        $user = $userRepository->findOneBy(['id' => $id]);

        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($hasher->isPasswordValid($user, $form->getData()['plainPassword'])) {

                $user->setPassword($hasher->hashPassword($user, $form->getData()['newPassword']));

                $manager->persist($user);
                $manager->flush();

                $this->addFlash('success', 'Le mot de passe a été modifié.');

                return $this->redirectToRoute('app_home');
            } else {
                $this->addFlash('warning', 'Le mot de passe renseigné est incorrect');
            }
        }

        return $this->render('user/edit_Password.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/user/{id}', 'app_user_show')]
    public function index()
    {
        return $this->render('user/profil.html.twig',[
            'controller_name' => 'UserController',
        ]);
    }
}
