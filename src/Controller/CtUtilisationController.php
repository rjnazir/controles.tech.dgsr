<?php

namespace App\Controller;

use App\Entity\CtUtilisation;
use App\Form\CtUtilisationType;
use App\Repository\CtUtilisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ut")
 */
class CtUtilisationController extends AbstractController
{
    /**
     * @Route("/", name="ut_index", methods={"GET"})
     */
    public function index(CtUtilisationRepository $ctUtilisationRepository): Response
    {
        return $this->render('ct_utilisation/index.html.twig', [
            'ct_utilisations' => $ctUtilisationRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="ut_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtUtilisationRepository $ctUtilisationRepository): Response
    {
        $ctUtilisation = new CtUtilisation();
        $form = $this->createForm(CtUtilisationType::class, $ctUtilisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctUtilisationRepository->add($ctUtilisation, true);

            $this->addFlash("success", "Ajout de l'utlisation effectué avec succès.");

            return $this->redirectToRoute('ut_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_utilisation/new.html.twig', [
            'ct_utilisation' => $ctUtilisation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ut_show", methods={"GET"})
     */
    public function show(CtUtilisation $ctUtilisation): Response
    {
        return $this->render('ct_utilisation/show.html.twig', [
            'ct_utilisation' => $ctUtilisation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ut_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtUtilisation $ctUtilisation, CtUtilisationRepository $ctUtilisationRepository): Response
    {
        $form = $this->createForm(CtUtilisationType::class, $ctUtilisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctUtilisationRepository->add($ctUtilisation, true);

            $this->addFlash("success", "Modification de l'utlisation effectuée avec succès.");

            return $this->redirectToRoute('ut_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_utilisation/edit.html.twig', [
            'ct_utilisation' => $ctUtilisation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ut_delete", methods={"POST"})
     */
    public function delete(Request $request, CtUtilisation $ctUtilisation, CtUtilisationRepository $ctUtilisationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctUtilisation->getId(), $request->request->get('_token'))) {
            $ctUtilisationRepository->remove($ctUtilisation, true);

            $this->addFlash("success", "Suppression de l'utlisation effectuée avec succès.");
        }

        return $this->redirectToRoute('ut_index', [], Response::HTTP_SEE_OTHER);
    }
}