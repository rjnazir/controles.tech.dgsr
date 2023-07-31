<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $role = $this->getUser()->getRoles();
        $centre = $this->getUser()->getCtCentre()->getId();

        $users = $userRepository->findAll();
        // if(in_array('ROLE_ADMIN', $role)){
        //     $users = $userRepository->findByRoleCentre('ROLE_USER', $centre);
        // }else{
        //     $users = $userRepository->findByRole('ROLE_USER');
        // }

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $RoleName = $this->getUser()->getRoles();
        $ctrCode = $this->getUser()->getCtCentre()->getCtrCode();

        $user = new User();
        $form = $this->createForm(UserType::class, $user, ['RoleName'=>$RoleName, 'ctrCode'=>$ctrCode]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->hashPassword($user, $user->getPassword())
            );

            $user->setUserCreatedAt(new DateTimeImmutable());

            $userRepository->add($user, true);

            $this->addFlash('success', 'Ajout utilisateur effectué avec succès.');

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $RoleName = $this->getUser()->getRoles();
        $ctrCode = $this->getUser()->getCtCentre()->getCtrCode();

        $form = $this->createForm(UserEditType::class, $user, ['RoleName'=>$RoleName, 'ctrCode'=>$ctrCode]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->hashPassword($user, $user->getPassword())
            );

            $user->setUserUpdatedAt(new DateTimeImmutable());

            $userRepository->add($user, true);

            $this->addFlash('success', 'Modification utilisateur effectué avec succès.');

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        $this->addFlash('success', 'Suppression utilisateur effectué avec succès.');

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
