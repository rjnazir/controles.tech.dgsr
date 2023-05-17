<?php

namespace App\Controller;

use App\Entity\CtDroitPtac;
use App\Form\CtDroitPtacType;
use App\Repository\CtDroitPtacRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dp")
 */
class CtDroitPtacController extends AbstractController
{
    /**
     * @Route("/", name="dp_index", methods={"GET"})
     */
    public function index(CtDroitPtacRepository $ctDroitPtacRepository): Response
    {
        return $this->render('ct_droit_ptac/index.html.twig', [
            'ct_droit_ptacs' => $ctDroitPtacRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="dp_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtDroitPtacRepository $ctDroitPtacRepository): Response
    {
        $ctDroitPtac = new CtDroitPtac();
        $form = $this->createForm(CtDroitPtacType::class, $ctDroitPtac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctDroitPtacRepository->add($ctDroitPtac, true);

            $this->addFlash("success", "Ajout de droit PTAC effecctué avec succès.");

            return $this->redirectToRoute('dp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_droit_ptac/new.html.twig', [
            'ct_droit_ptac' => $ctDroitPtac,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="dp_show", methods={"GET"})
     */
    public function show(CtDroitPtac $ctDroitPtac): Response
    {
        return $this->render('ct_droit_ptac/show.html.twig', [
            'ct_droit_ptac' => $ctDroitPtac,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dp_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtDroitPtac $ctDroitPtac, CtDroitPtacRepository $ctDroitPtacRepository): Response
    {
        $form = $this->createForm(CtDroitPtacType::class, $ctDroitPtac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctDroitPtacRepository->add($ctDroitPtac, true);
            
            $this->addFlash("success", "Modification de droit PTAC effecctuée avec succès.");

            return $this->redirectToRoute('dp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_droit_ptac/edit.html.twig', [
            'ct_droit_ptac' => $ctDroitPtac,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="dp_delete", methods={"POST"})
     */
    public function delete(Request $request, CtDroitPtac $ctDroitPtac, CtDroitPtacRepository $ctDroitPtacRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctDroitPtac->getId(), $request->request->get('_token'))) {
            $ctDroitPtacRepository->remove($ctDroitPtac, true);

            $this->addFlash("success", "Suppression de droit PTAC effecctuée avec succès.");
        }

        return $this->redirectToRoute('dp_index', [], Response::HTTP_SEE_OTHER);
    }
}
