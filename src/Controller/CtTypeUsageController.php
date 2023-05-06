<?php

namespace App\Controller;

use App\Entity\CtTypeUsage;
use App\Form\CtTypeUsageType;
use App\Repository\CtTypeUsageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type_usage")
 */
class CtTypeUsageController extends AbstractController
{
    /**
     * @Route("/", name="type_usage_index", methods={"GET"})
     */
    public function index(CtTypeUsageRepository $ctTypeUsageRepository): Response
    {
        return $this->render('ct_type_usage/index.html.twig', [
            'ct_type_usages' => $ctTypeUsageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_usage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtTypeUsageRepository $ctTypeUsageRepository): Response
    {
        $ctTypeUsage = new CtTypeUsage();
        $form = $this->createForm(CtTypeUsageType::class, $ctTypeUsage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctTypeUsageRepository->add($ctTypeUsage, true);

            return $this->redirectToRoute('app_ct_type_usage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_type_usage/new.html.twig', [
            'ct_type_usage' => $ctTypeUsage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_usage_show", methods={"GET"})
     */
    public function show(CtTypeUsage $ctTypeUsage): Response
    {
        return $this->render('ct_type_usage/show.html.twig', [
            'ct_type_usage' => $ctTypeUsage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_usage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtTypeUsage $ctTypeUsage, CtTypeUsageRepository $ctTypeUsageRepository): Response
    {
        $form = $this->createForm(CtTypeUsageType::class, $ctTypeUsage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctTypeUsageRepository->add($ctTypeUsage, true);

            return $this->redirectToRoute('app_ct_type_usage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_type_usage/edit.html.twig', [
            'ct_type_usage' => $ctTypeUsage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_usage_delete", methods={"POST"})
     */
    public function delete(Request $request, CtTypeUsage $ctTypeUsage, CtTypeUsageRepository $ctTypeUsageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctTypeUsage->getId(), $request->request->get('_token'))) {
            $ctTypeUsageRepository->remove($ctTypeUsage, true);
        }

        return $this->redirectToRoute('app_ct_type_usage_index', [], Response::HTTP_SEE_OTHER);
    }
}
