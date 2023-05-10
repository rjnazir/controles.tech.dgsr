<?php

namespace App\Controller;

use App\Entity\CtTypeReception;
use App\Form\CtTypeReceptionType;
use App\Repository\CtTypeReceptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type_reception")
 */
class CtTypeReceptionController extends AbstractController
{
    /**
     * @Route("/", name="type_reception_index", methods={"GET"})
     */
    public function index(CtTypeReceptionRepository $ctTypeReceptionRepository): Response
    {
        return $this->render('ct_type_reception/index.html.twig', [
            'ct_type_receptions' => $ctTypeReceptionRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="type_reception_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtTypeReceptionRepository $ctTypeReceptionRepository): Response
    {
        $ctTypeReception = new CtTypeReception();
        $form = $this->createForm(CtTypeReceptionType::class, $ctTypeReception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctTypeReceptionRepository->add($ctTypeReception, true);

            $this->addFlash('success', 'Ajout type réception effectué avec succès.');

            return $this->redirectToRoute('type_reception_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_type_reception/new.html.twig', [
            'ct_type_reception' => $ctTypeReception,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_reception_show", methods={"GET"})
     */
    public function show(CtTypeReception $ctTypeReception): Response
    {
        return $this->render('ct_type_reception/show.html.twig', [
            'ct_type_reception' => $ctTypeReception,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_reception_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtTypeReception $ctTypeReception, CtTypeReceptionRepository $ctTypeReceptionRepository): Response
    {
        $form = $this->createForm(CtTypeReceptionType::class, $ctTypeReception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctTypeReceptionRepository->add($ctTypeReception, true);

            $this->addFlash('success', 'Modification type réception effectué avec succès.');

            return $this->redirectToRoute('type_reception_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_type_reception/edit.html.twig', [
            'ct_type_reception' => $ctTypeReception,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_reception_delete", methods={"POST"})
     */
    public function delete(Request $request, CtTypeReception $ctTypeReception, CtTypeReceptionRepository $ctTypeReceptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTypeReception->getId(), $request->request->get('_token'))) {
            $ctTypeReceptionRepository->remove($ctTypeReception, true);

            $this->addFlash('success', 'Suppression type réception effectué avec succès.');

        }

        return $this->redirectToRoute('type_reception_index', [], Response::HTTP_SEE_OTHER);
    }
}
