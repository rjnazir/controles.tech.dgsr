<?php

namespace App\Controller;

use App\Entity\CtReception;
use App\Form\CtReceptionType;
use App\Repository\CtReceptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct/reception")
 */
class CtReceptionController extends AbstractController
{
    /**
     * @Route("/", name="ct_reception_index", methods={"GET"})
     */
    public function index(CtReceptionRepository $ctReceptionRepository): Response
    {
        return $this->render('ct_reception/index.html.twig', [
            // 'ct_receptions' => $ctReceptionRepository->findAll(),
            'ct_receptions' => $ctReceptionRepository->findByDayNotDeleted(date('Y-m-d')),
        ]);
    }

    /**
     * @Route("/new", name="ct_reception_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtReceptionRepository $ctReceptionRepository): Response
    {
        $ctCentre = $this->getUser()->getCtCentre()->getId();

        $ctReception = new CtReception();
        $form = $this->createForm(CtReceptionType::class, $ctReception, ['ctCentre'=>$ctCentre]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctReceptionRepository->add($ctReception, true);

            return $this->redirectToRoute('app_ct_reception_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_reception/new.html.twig', [
            'ct_reception' => $ctReception,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ct_reception_show", methods={"GET"})
     */
    public function show(CtReception $ctReception): Response
    {
        return $this->render('ct_reception/show.html.twig', [
            'ct_reception' => $ctReception,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_reception_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtReception $ctReception, CtReceptionRepository $ctReceptionRepository): Response
    {
        $ctCentre = $this->getUser()->getCtCentre()->getId();

        $form = $this->createForm(CtReceptionType::class, $ctReception, ['ctCentre'=>$ctCentre]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctReceptionRepository->add($ctReception, true);

            return $this->redirectToRoute('ct_reception_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_reception/edit.html.twig', [
            'ct_reception' => $ctReception,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ct_reception_delete", methods={"POST"})
     */
    public function delete(Request $request, CtReception $ctReception, CtReceptionRepository $ctReceptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctReception->getId(), $request->request->get('_token'))) {
            $ctReceptionRepository->remove($ctReception, true);
        }

        return $this->redirectToRoute('ct_reception_index', [], Response::HTTP_SEE_OTHER);
    }
}
