<?php

namespace App\Controller;

use App\Entity\CtCarrosserie;
use App\Form\CtCarrosserieType;
use App\Repository\CtCarrosserieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/crs")
 */
class CtCarrosserieController extends AbstractController
{
    /**
     * @Route("/", name="crs_index", methods={"GET"})
     */
    public function index(CtCarrosserieRepository $ctCarrosserieRepository): Response
    {
        return $this->render('ct_carrosserie/index.html.twig', [
            'ct_carrosseries' => $ctCarrosserieRepository->findby([],['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="crs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtCarrosserieRepository $ctCarrosserieRepository): Response
    {
        $ctCarrosserie = new CtCarrosserie();
        $form = $this->createForm(CtCarrosserieType::class, $ctCarrosserie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctCarrosserieRepository->add($ctCarrosserie, true);
            
            $this->addFlash('success', 'Ajout de carrosserie effectuée avec succès.');

            return $this->redirectToRoute('crs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_carrosserie/new.html.twig', [
            'ct_carrosserie' => $ctCarrosserie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="crs_show", methods={"GET"})
     */
    public function show(CtCarrosserie $ctCarrosserie): Response
    {
        return $this->render('ct_carrosserie/show.html.twig', [
            'ct_carrosserie' => $ctCarrosserie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="crs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtCarrosserie $ctCarrosserie, CtCarrosserieRepository $ctCarrosserieRepository): Response
    {
        $form = $this->createForm(CtCarrosserieType::class, $ctCarrosserie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctCarrosserieRepository->add($ctCarrosserie, true);

            $this->addFlash('success', 'Modification de carrosserie effectuée avec succès.');

            return $this->redirectToRoute('crs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_carrosserie/edit.html.twig', [
            'ct_carrosserie' => $ctCarrosserie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="crs_delete", methods={"POST"})
     */
    public function delete(Request $request, CtCarrosserie $ctCarrosserie, CtCarrosserieRepository $ctCarrosserieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctCarrosserie->getId(), $request->request->get('_token'))) {
            $ctCarrosserieRepository->remove($ctCarrosserie, true);

            $this->addFlash('success', 'Suppression de carrosserie effectuée avec succès.');

        }

        return $this->redirectToRoute('crs_index', [], Response::HTTP_SEE_OTHER);
    }
}
