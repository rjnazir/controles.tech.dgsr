<?php

namespace App\Controller;

use App\Entity\CtUsage;
use App\Form\CtUsageType;
use App\Repository\CtUsageRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/usage")
 */
class CtUsageController extends AbstractController
{
    /**
     * @Route("/", name="usage_index", methods={"GET"})
     */
    public function index(CtUsageRepository $ctUsageRepository): Response
    {
        return $this->render('ct_usage/index.html.twig', [
            'ct_usages' => $ctUsageRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="usage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtUsageRepository $ctUsageRepository): Response
    {
        $ctUsage = new CtUsage();
        $form = $this->createForm(CtUsageType::class, $ctUsage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ctUsage->setUsgCreated(new DateTimeImmutable());
            $ctUsage->setUsgUpdated(NULL);

            $ctUsageRepository->add($ctUsage, true);

            $this->addFlash('success', 'Ajout usage effectué avec succès.');

            return $this->redirectToRoute('usage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_usage/new.html.twig', [
            'ct_usage' => $ctUsage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="usage_show", methods={"GET"})
     */
    public function show(CtUsage $ctUsage): Response
    {
        return $this->render('ct_usage/show.html.twig', [
            'ct_usage' => $ctUsage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="usage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtUsage $ctUsage, CtUsageRepository $ctUsageRepository): Response
    {
        $form = $this->createForm(CtUsageType::class, $ctUsage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ctUsage->setUsgUpdated(new DateTimeImmutable());

            $ctUsageRepository->add($ctUsage, true);

            $this->addFlash('success', 'Modification usage effectué avec succès.');

            return $this->redirectToRoute('usage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_usage/edit.html.twig', [
            'ct_usage' => $ctUsage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="usage_delete", methods={"POST"})
     */
    public function delete(Request $request, CtUsage $ctUsage, CtUsageRepository $ctUsageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctUsage->getId(), $request->request->get('_token'))) {
            $ctUsageRepository->remove($ctUsage, true);

            $this->addFlash('success', 'Suppression usage effectué avec succès.');
        }

        return $this->redirectToRoute('usage_index', [], Response::HTTP_SEE_OTHER);
    }
}
