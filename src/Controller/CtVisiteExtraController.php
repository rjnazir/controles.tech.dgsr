<?php

namespace App\Controller;

use App\Entity\CtVisiteExtra;
use App\Form\CtVisiteExtraType;
use App\Repository\CtVisiteExtraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vtex")
 */
class CtVisiteExtraController extends AbstractController
{
    /**
     * @Route("/", name="vtex_index", methods={"GET"})
     */
    public function index(CtVisiteExtraRepository $ctVisiteExtraRepository): Response
    {
        return $this->render('ct_visite_extra/index.html.twig', [
            'ct_visite_extras' => $ctVisiteExtraRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vtex_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtVisiteExtraRepository $ctVisiteExtraRepository): Response
    {
        $ctVisiteExtra = new CtVisiteExtra();
        $form = $this->createForm(CtVisiteExtraType::class, $ctVisiteExtra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctVisiteExtraRepository->add($ctVisiteExtra, true);

            $this->addFlash("Success", "Ajout de visite extra effectué avec succès.");

            return $this->redirectToRoute('vtex_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_visite_extra/new.html.twig', [
            'ct_visite_extra' => $ctVisiteExtra,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="vtex_show", methods={"GET"})
     */
    public function show(CtVisiteExtra $ctVisiteExtra): Response
    {
        return $this->render('ct_visite_extra/show.html.twig', [
            'ct_visite_extra' => $ctVisiteExtra,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vtex_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtVisiteExtra $ctVisiteExtra, CtVisiteExtraRepository $ctVisiteExtraRepository): Response
    {
        $form = $this->createForm(CtVisiteExtraType::class, $ctVisiteExtra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctVisiteExtraRepository->add($ctVisiteExtra, true);

            $this->addFlash("Success", "Modification de visite extra effectuée avec succès.");

            return $this->redirectToRoute('vtex_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_visite_extra/edit.html.twig', [
            'ct_visite_extra' => $ctVisiteExtra,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="vtex_delete", methods={"POST"})
     */
    public function delete(Request $request, CtVisiteExtra $ctVisiteExtra, CtVisiteExtraRepository $ctVisiteExtraRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctVisiteExtra->getId(), $request->request->get('_token'))) {
            $ctVisiteExtraRepository->remove($ctVisiteExtra, true);

            $this->addFlash("Success", "Suppression de visite extra effectuée avec succès.");

        }

        return $this->redirectToRoute('vtex_index', [], Response::HTTP_SEE_OTHER);
    }
}
