<?php

namespace App\Controller;

use App\Entity\CtTypeDroitPtac;
use App\Form\CtTypeDroitPtacType;
use App\Repository\CtTypeDroitPtacRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tp_drt_ptac")
 */
class CtTypeDroitPtacController extends AbstractController
{
    /**
     * @Route("/", name="tp_drt_ptac_index", methods={"GET"})
     */
    public function index(CtTypeDroitPtacRepository $ctTypeDroitPtacRepository): Response
    {
        return $this->render('ct_type_droit_ptac/index.html.twig', [
            'ct_type_droit_ptacs' => $ctTypeDroitPtacRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="tp_drt_ptac_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtTypeDroitPtacRepository $ctTypeDroitPtacRepository): Response
    {
        $ctTypeDroitPtac = new CtTypeDroitPtac();
        $form = $this->createForm(CtTypeDroitPtacType::class, $ctTypeDroitPtac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctTypeDroitPtacRepository->add($ctTypeDroitPtac, true);

            $this->addFlash('success', 'Ajout de type de droit PTAC effectué avec succès.');

            return $this->redirectToRoute('tp_drt_ptac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_type_droit_ptac/new.html.twig', [
            'ct_type_droit_ptac' => $ctTypeDroitPtac,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="tp_drt_ptac_show", methods={"GET"})
     */
    public function show(CtTypeDroitPtac $ctTypeDroitPtac): Response
    {
        return $this->render('ct_type_droit_ptac/show.html.twig', [
            'ct_type_droit_ptac' => $ctTypeDroitPtac,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tp_drt_ptac_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtTypeDroitPtac $ctTypeDroitPtac, CtTypeDroitPtacRepository $ctTypeDroitPtacRepository): Response
    {
        $form = $this->createForm(CtTypeDroitPtacType::class, $ctTypeDroitPtac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctTypeDroitPtacRepository->add($ctTypeDroitPtac, true);

            $this->addFlash('success', 'Modification de type de droit PTAC effectuée avec succès.');

            return $this->redirectToRoute('tp_drt_ptac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_type_droit_ptac/edit.html.twig', [
            'ct_type_droit_ptac' => $ctTypeDroitPtac,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="tp_drt_ptac_delete", methods={"POST"})
     */
    public function delete(Request $request, CtTypeDroitPtac $ctTypeDroitPtac, CtTypeDroitPtacRepository $ctTypeDroitPtacRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTypeDroitPtac->getId(), $request->request->get('_token'))) {
            $ctTypeDroitPtacRepository->remove($ctTypeDroitPtac, true);

            $this->addFlash('success', 'Suppression de type de droit PTAC effectuée avec succès.');
        }

        return $this->redirectToRoute('tp_drt_ptac_index', [], Response::HTTP_SEE_OTHER);
    }
}
