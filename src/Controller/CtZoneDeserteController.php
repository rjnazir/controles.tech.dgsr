<?php

namespace App\Controller;

use App\Entity\CtZoneDeserte;
use App\Form\CtZoneDeserteType;
use App\Repository\CtZoneDeserteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/zd")
 */
class CtZoneDeserteController extends AbstractController
{
    /**
     * @Route("/", name="zd_index", methods={"GET"})
     */
    public function index(CtZoneDeserteRepository $ctZoneDeserteRepository): Response
    {
        return $this->render('ct_zone_deserte/index.html.twig', [
            'ct_zone_desertes' => $ctZoneDeserteRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="zd_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtZoneDeserteRepository $ctZoneDeserteRepository): Response
    {
        $ctZoneDeserte = new CtZoneDeserte();
        $form = $this->createForm(CtZoneDeserteType::class, $ctZoneDeserte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctZoneDeserteRepository->add($ctZoneDeserte, true);

            $this->addFlash("success", "Ajout de la zone de servitude effectué avec succès.");

            return $this->redirectToRoute('zd_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_zone_deserte/new.html.twig', [
            'ct_zone_deserte' => $ctZoneDeserte,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="zd_show", methods={"GET"})
     */
    public function show(CtZoneDeserte $ctZoneDeserte): Response
    {
        return $this->render('ct_zone_deserte/show.html.twig', [
            'ct_zone_deserte' => $ctZoneDeserte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="zd_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtZoneDeserte $ctZoneDeserte, CtZoneDeserteRepository $ctZoneDeserteRepository): Response
    {
        $form = $this->createForm(CtZoneDeserteType::class, $ctZoneDeserte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctZoneDeserteRepository->add($ctZoneDeserte, true);

            $this->addFlash("success", "Modification de la zone de servitude effectuée avec succès.");

            return $this->redirectToRoute('zd_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_zone_deserte/edit.html.twig', [
            'ct_zone_deserte' => $ctZoneDeserte,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="zd_delete", methods={"POST"})
     */
    public function delete(Request $request, CtZoneDeserte $ctZoneDeserte, CtZoneDeserteRepository $ctZoneDeserteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctZoneDeserte->getId(), $request->request->get('_token'))) {
            $ctZoneDeserteRepository->remove($ctZoneDeserte, true);

            $this->addFlash("success", "Suppression de la zone de servitude effectuée avec succès.");
        }

        return $this->redirectToRoute('zd_index', [], Response::HTTP_SEE_OTHER);
    }
}
