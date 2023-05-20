<?php

namespace App\Controller;

use App\Entity\CtMarque;
use App\Form\CtMarqueType;
use App\Repository\CtMarqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mrq")
 */
class CtMarqueController extends AbstractController
{
    /**
     * @Route("/", name="mrq_index", methods={"GET"})
     */
    public function index(CtMarqueRepository $ctMarqueRepository): Response
    {
        return $this->render('ct_marque/index.html.twig', [
            'ct_marques' => $ctMarqueRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="mrq_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtMarqueRepository $ctMarqueRepository): Response
    {
        $ctMarque = new CtMarque();
        $form = $this->createForm(CtMarqueType::class, $ctMarque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctMarqueRepository->add($ctMarque, true);

            $this->addFlash("seccuss", "Ajout de marque effectué avec succès.");

            return $this->redirectToRoute('mrq_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_marque/new.html.twig', [
            'ct_marque' => $ctMarque,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="mrq_show", methods={"GET"})
     */
    public function show(CtMarque $ctMarque): Response
    {
        return $this->render('ct_marque/show.html.twig', [
            'ct_marque' => $ctMarque,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mrq_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtMarque $ctMarque, CtMarqueRepository $ctMarqueRepository): Response
    {
        $form = $this->createForm(CtMarqueType::class, $ctMarque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctMarqueRepository->add($ctMarque, true);

            $this->addFlash("success", "Modification de la marque effectuée avec succès.");

            return $this->redirectToRoute('mrq_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_marque/edit.html.twig', [
            'ct_marque' => $ctMarque,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="mrq_delete", methods={"POST"})
     */
    public function delete(Request $request, CtMarque $ctMarque, CtMarqueRepository $ctMarqueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctMarque->getId(), $request->request->get('_token'))) {
            $ctMarqueRepository->remove($ctMarque, true);

            $this->addFlash("success", "Suppression de la marque effectuée avec succès.");
        }

        return $this->redirectToRoute('mrq_index', [], Response::HTTP_SEE_OTHER);
    }
}
