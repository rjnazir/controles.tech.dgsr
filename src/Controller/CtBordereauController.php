<?php

namespace App\Controller;

use App\Entity\CtBordereau;
use App\Form\CtBordereauType;
use App\Repository\CtBordereauRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("be")
 */
class CtBordereauController extends AbstractController
{
    /**
     * @Route("/", name="be_index", methods={"GET"})
     */
    public function index(CtBordereauRepository $ctBordereauRepository): Response
    {
        return $this->render('ct_bordereau/index.html.twig', [
            'ct_bordereaus' => $ctBordereauRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="be_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtBordereauRepository $ctBordereauRepository): Response
    {
        $ctCentre = $this->getUser()->getCtCentre()->getId();

        $ctBordereau = new CtBordereau();
        $form = $this->createForm(CtBordereauType::class, $ctBordereau, ['idCentre'=>$ctCentre]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctBordereau->setBeCreatedAt(new DateTimeImmutable());
            $ctBordereau->setUser($this->getUser());

            $ctBordereauRepository->add($ctBordereau, true);

            $this->addFlash("success", "Ajout de l'imprimé dans le BE effectué avec succès.");

            return $this->redirectToRoute('be_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_bordereau/new.html.twig', [
            'ct_bordereau' => $ctBordereau,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="be_show", methods={"GET"})
     */
    public function show(CtBordereau $ctBordereau): Response
    {
        return $this->render('ct_bordereau/show.html.twig', [
            'ct_bordereau' => $ctBordereau,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="be_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtBordereau $ctBordereau, CtBordereauRepository $ctBordereauRepository): Response
    {
        $ctCentre = $this->getUser()->getCtCentre()->getId();

        $form = $this->createForm(CtBordereauType::class, $ctBordereau, ['idCentre'=>$ctCentre]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctBordereau->setBeUpdatedAt(new DateTimeImmutable());
            $ctBordereau->setUser($this->getUser());
            $ctBordereauRepository->add($ctBordereau, true);

            $this->addFlash("success", "Modification de l'imprimé dans le BE effectué avec succès.");

            return $this->redirectToRoute('be_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_bordereau/edit.html.twig', [
            'ct_bordereau' => $ctBordereau,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="be_delete", methods={"POST"})
     */
    public function delete(Request $request, CtBordereau $ctBordereau, CtBordereauRepository $ctBordereauRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctBordereau->getId(), $request->request->get('_token'))) {
            $ctBordereauRepository->remove($ctBordereau, true);

            $this->addFlash("success", "Suppression de l'imprimé dans le BE effectué avec succès.");
        }

        return $this->redirectToRoute('be_index', [], Response::HTTP_SEE_OTHER);
    }
}
