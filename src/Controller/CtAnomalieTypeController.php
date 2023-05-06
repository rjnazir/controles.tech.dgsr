<?php

namespace App\Controller;

use App\Entity\CtAnomalieType;
use App\Form\CtAnomalieTypeType;
use App\Repository\CtAnomalieTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Qipsius\TCPDFBundle\Controller\TCPDFController;

/**
 * @Route("/ct_anomalie_type")
 */
class CtAnomalieTypeController extends AbstractController
{

    /**
     * @Route("/", name="app_ct_anomalie_type_index", methods={"GET"})
     */
    public function index(CtAnomalieTypeRepository $ctAnomalieTypeRepository): Response
    {
        return $this->render('ct_anomalie_type/index.html.twig', [
            'ct_anomalie_types'  => $ctAnomalieTypeRepository->findBy([],['id' => 'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="app_ct_anomalie_type_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtAnomalieTypeRepository $ctAnomalieTypeRepository): Response
    {
        $ctAnomalieType = new CtAnomalieType();
        $form = $this->createForm(CtAnomalieTypeType::class, $ctAnomalieType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctAnomalieTypeRepository->add($ctAnomalieType, true);

            $this->addFlash('success', 'Ajout de type d\'anomalie effectué avec succès.');

            return $this->redirectToRoute('app_ct_anomalie_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_anomalie_type/new.html.twig', [
            'ct_anomalie_type' => $ctAnomalieType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ct_anomalie_type_show", methods={"GET"})
     */
    public function show(CtAnomalieType $ctAnomalieType): Response
    {
        return $this->render('ct_anomalie_type/show.html.twig', [
            'ct_anomalie_type' => $ctAnomalieType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ct_anomalie_type_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtAnomalieType $ctAnomalieType, CtAnomalieTypeRepository $ctAnomalieTypeRepository): Response
    {
        $form = $this->createForm(CtAnomalieTypeType::class, $ctAnomalieType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctAnomalieTypeRepository->add($ctAnomalieType, true);

            $this->addFlash('success', 'Modification type d\'anomalie effectué avec succès.');

            return $this->redirectToRoute('app_ct_anomalie_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_anomalie_type/edit.html.twig', [
            'ct_anomalie_type' => $ctAnomalieType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ct_anomalie_type_delete", methods={"POST"})
     */
    public function delete(Request $request, CtAnomalieType $ctAnomalieType, CtAnomalieTypeRepository $ctAnomalieTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctAnomalieType->getId(), $request->request->get('_token'))) {
            $ctAnomalieTypeRepository->remove($ctAnomalieType, true);

            $this->addFlash('success', 'Suppression type d\'anomalie effectué avec succès.');
        }

        return $this->redirectToRoute('app_ct_anomalie_type_index', [], Response::HTTP_SEE_OTHER);
    }
}