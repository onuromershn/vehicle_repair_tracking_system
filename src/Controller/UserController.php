<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use function Symfony\Component\String\u;

#[IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function list(UserRepository $userRepository): Response
    {
        $users = $userRepository->getAllUser();

        return $this->render('user/list.html.twig', [
            'controller_name' => 'UserController',
            'users'=>$users

        ]);
    }

    #[Route('/user/add', name: 'app_user_add')]
    public function add(UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager,UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $users = $userRepository->getAllUser();

        if ($request->getMethod() === Request::METHOD_POST){

            $user = new User();
            $user->setEmail($request->request->get('userEmail'));

            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $request->request->get('plainPassword')
                )
            );
            $user->setRoles(array($request->request->get('userRole')));
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_users');
        }

        return $this->render('user/add.html.twig', [
            'controller_name' => 'UserController',
            'users'=>$users,
            'userRoles'=>$userRepository->userRoles()
        ]);
    }
}
