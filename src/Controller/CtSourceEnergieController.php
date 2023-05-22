<?php

namespace App\Controller;

use App\Entity\CtSourceEnergie;
use App\Form\CtSourceEnergieType;
use App\Repository\CtSourceEnergieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sre")
 */
class CtSourceEnergieController extends AbstractController
{
    /**
     * @Route("/", name="sre_index", methods={"GET"})
     */
    public function index(CtSourceEnergieRepository $ctSourceEnergieRepository): Response
    {
        return $this->render('ct_source_energie/index.html.twig', [
            'ct_source_energies' => $ctSourceEnergieRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="sre_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtSourceEnergieRepository $ctSourceEnergieRepository): Response
    {
        $ctSourceEnergie = new CtSourceEnergie();
        $form = $this->createForm(CtSourceEnergieType::class, $ctSourceEnergie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctSourceEnergieRepository->add($ctSourceEnergie, true);

            $this->addFlash("success", "Ajout de source d'énergie effectué avec succès.");

            return $this->redirectToRoute('sre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_source_energie/new.html.twig', [
            'ct_source_energie' => $ctSourceEnergie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sre_show", methods={"GET"})
     */
    public function show(CtSourceEnergie $ctSourceEnergie): Response
    {
        return $this->render('ct_source_energie/show.html.twig', [
            'ct_source_energie' => $ctSourceEnergie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtSourceEnergie $ctSourceEnergie, CtSourceEnergieRepository $ctSourceEnergieRepository): Response
    {
        $form = $this->createForm(CtSourceEnergieType::class, $ctSourceEnergie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctSourceEnergieRepository->add($ctSourceEnergie, true);

            $this->addFlash("success", "Modification de la source d'énergie effectuée avec succès;");

            return $this->redirectToRoute('sre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_source_energie/edit.html.twig', [
            'ct_source_energie' => $ctSourceEnergie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sre_delete", methods={"POST"})
     */
    public function delete(Request $request, CtSourceEnergie $ctSourceEnergie, CtSourceEnergieRepository $ctSourceEnergieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctSourceEnergie->getId(), $request->request->get('_token'))) {
            $ctSourceEnergieRepository->remove($ctSourceEnergie, true);

            $this->addFlash("success", "Suppression de la source d'énergie effectuée avec succès.");
        }

        return $this->redirectToRoute('sre_index', [], Response::HTTP_SEE_OTHER);
    }
}
