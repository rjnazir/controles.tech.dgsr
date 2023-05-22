<?php

namespace App\Controller;

use App\Entity\CtImprimeTech;
use App\Form\CtImprimeTechType;
use App\Repository\CtImprimeTechRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/it")
 */
class CtImprimeTechController extends AbstractController
{
    /**
     * @Route("/", name="it_index", methods={"GET"})
     */
    public function index(CtImprimeTechRepository $ctImprimeTechRepository): Response
    {
        return $this->render('ct_imprime_tech/index.html.twig', [
            'ct_imprime_teches' => $ctImprimeTechRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="it_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtImprimeTechRepository $ctImprimeTechRepository): Response
    {
        $ctImprimeTech = new CtImprimeTech();
        $form = $this->createForm(CtImprimeTechType::class, $ctImprimeTech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctImprimeTech->setPrttCreatedAt(new DateTimeImmutable());
            $ctImprimeTech->setUser($this->getUser());

            $ctImprimeTechRepository->add($ctImprimeTech, true);

            $this->addFlash("success", "Ajout du type d'imprimé technique effectué avec succès.");

            return $this->redirectToRoute('it_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_imprime_tech/new.html.twig', [
            'ct_imprime_tech' => $ctImprimeTech,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="it_show", methods={"GET"})
     */
    public function show(CtImprimeTech $ctImprimeTech): Response
    {
        return $this->render('ct_imprime_tech/show.html.twig', [
            'ct_imprime_tech' => $ctImprimeTech,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="it_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtImprimeTech $ctImprimeTech, CtImprimeTechRepository $ctImprimeTechRepository): Response
    {
        $form = $this->createForm(CtImprimeTechType::class, $ctImprimeTech);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctImprimeTech->setPrttUpdatedAt(new DateTimeImmutable());
            $ctImprimeTech->setUser($this->getUser());

            $ctImprimeTechRepository->add($ctImprimeTech, true);

            $this->addFlash("success", "Modification du type d'imprimé technique effectuée avec succès.");

            return $this->redirectToRoute('it_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_imprime_tech/edit.html.twig', [
            'ct_imprime_tech' => $ctImprimeTech,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="it_delete", methods={"POST"})
     */
    public function delete(Request $request, CtImprimeTech $ctImprimeTech, CtImprimeTechRepository $ctImprimeTechRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctImprimeTech->getId(), $request->request->get('_token'))) {
            $ctImprimeTechRepository->remove($ctImprimeTech, true);

            $this->addFlash("success", "Suppression du type d'emprimé technique effectuée avec succès.");
        }

        return $this->redirectToRoute('it_index', [], Response::HTTP_SEE_OTHER);
    }
}
