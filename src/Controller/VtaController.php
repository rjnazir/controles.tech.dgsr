<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\VtaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\UserRepository;
use DateTimeImmutable;

/**
 * @Route("/vta")
 */
class VtaController extends AbstractController
{
    /**
     * @Route("/", name="app_vta_index")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('vta/index.html.twig', [
            'users' => $userRepository->findByVta('ROLE_VTA'),
        ]);
    }

    /**
     * @Route("/new", name="app_vta_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $RoleName = $this->getUser()->getRoles();
        $ctrCode = $this->getUser()->getCtCentre()->getCtrCode();

        $user = new User();
        $form = $this->createForm(VtaType::class, $user, ['RoleName'=>$RoleName, 'ctrCode'=>$ctrCode]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setRoles(['ROLE_VTA']);

            $user->setUsername(uniqid());

            $user->setPassword($passwordEncoder->hashPassword($user, uniqid()));

            $user->setUserCreatedAt(new DateTimeImmutable());

            $userRepository->add($user, true);

            $this->addFlash('success', 'Ajout du vérificateur effectué avec succès.');

            return $this->redirectToRoute('app_vta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vta/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_vta_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('vta/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_vta_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $RoleName = $this->getUser()->getRoles();
        $ctrCode = $this->getUser()->getCtCentre()->getCtrCode();

        $form = $this->createForm(VtaType::class, $user, ['RoleName'=>$RoleName, 'ctrCode'=>$ctrCode]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setUserUpdatedAt(new DateTimeImmutable());

            $userRepository->add($user, true);

            $this->addFlash('success', 'Modification du vérificateur effectué avec succès.');

            return $this->redirectToRoute('app_vta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vta/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_vta_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);

            $this->addFlash('success', 'Suppression du vérificateur effectué avec succès.');
        }

        return $this->redirectToRoute('app_vta_index', [], Response::HTTP_SEE_OTHER);
    }
}
