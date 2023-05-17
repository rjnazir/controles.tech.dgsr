<?php

namespace App\Controller;

use App\Entity\CtProcesVerbal;
use App\Form\CtProcesVerbalType;
use App\Repository\CtProcesVerbalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pv")
 */
class CtProcesVerbalController extends AbstractController
{
    /**
     * @Route("/", name="pv_index", methods={"GET"})
     */
    public function index(CtProcesVerbalRepository $ctProcesVerbalRepository): Response
    {
        return $this->render('ct_proces_verbal/index.html.twig', [
            'ct_proces_verbals' => $ctProcesVerbalRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="pv_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtProcesVerbalRepository $ctProcesVerbalRepository): Response
    {
        $ctProcesVerbal = new CtProcesVerbal();
        $form = $this->createForm(CtProcesVerbalType::class, $ctProcesVerbal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctProcesVerbalRepository->add($ctProcesVerbal, true);

            $this->addFlash("success", "Ajout de tarif de procès-verbal effectué avec succès.");

            return $this->redirectToRoute('pv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_proces_verbal/new.html.twig', [
            'ct_proces_verbal' => $ctProcesVerbal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pv_show", methods={"GET"})
     */
    public function show(CtProcesVerbal $ctProcesVerbal): Response
    {
        return $this->render('ct_proces_verbal/show.html.twig', [
            'ct_proces_verbal' => $ctProcesVerbal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pv_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtProcesVerbal $ctProcesVerbal, CtProcesVerbalRepository $ctProcesVerbalRepository): Response
    {
        $form = $this->createForm(CtProcesVerbalType::class, $ctProcesVerbal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctProcesVerbalRepository->add($ctProcesVerbal, true);

            $this->addFlash("success", "Modification de tarif de procès-verbal effectuée avec succès.");

            return $this->redirectToRoute('pv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_proces_verbal/edit.html.twig', [
            'ct_proces_verbal' => $ctProcesVerbal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pv_delete", methods={"POST"})
     */
    public function delete(Request $request, CtProcesVerbal $ctProcesVerbal, CtProcesVerbalRepository $ctProcesVerbalRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctProcesVerbal->getId(), $request->request->get('_token'))) {
            $ctProcesVerbalRepository->remove($ctProcesVerbal, true);

            $this->addFlash("success", "Suppression de tarif de procès-verbal effectuée avec succès.");
        }

        return $this->redirectToRoute('pv_index', [], Response::HTTP_SEE_OTHER);
    }
}
