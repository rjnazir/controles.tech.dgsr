<?php

namespace App\Controller;

use DateTime;
use DateTimeImmutable;
use App\Entity\CtContenu;
use App\Entity\CtExpressionBesoin;
use App\Form\CtContenuType;
use App\Repository\CtCentreRepository;
use App\Repository\CtContenuRepository;
use App\Repository\CtExpressionBesoinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contenu")
 */
class CtContenuController extends AbstractController
{
    /**
     * @Route("/", name="contenu_index", methods={"GET"})
     */
    public function index(CtContenuRepository $ctContenuRepository): Response
    {
        // return $this->render('ct_contenu/index.html.twig', [
        //     'ct_contenus' => $ctContenuRepository->findAll(),
        // ]);
        $ctExpressionBesoinRepository = $this->getDoctrine()->getManager()->getRepository(CtExpressionBesoin::class);
        $ctCentre = $this->getUser()->getCtCentre();
        $edbDateEdit = new DateTime('now');
        return $this->render('ct_contenu/index.html.twig', [
            'ct_contenus' => $ctContenuRepository->contenuWithCentreDate($ctCentre, $edbDateEdit->format('Y-m-d')),
            'idEdb' => $ctExpressionBesoinRepository->findOneBy(['ctCentre' => $ctCentre, 'edbDateEdit' => $edbDateEdit])->getId(),
        ]);
    }

    /**
     * @Route("/new", name="contenu_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtContenuRepository $ctContenuRepository): Response
    {

        $ctContenu = new CtContenu();
        $form = $this->createForm(CtContenuType::class, $ctContenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($ctContenu->getCtExpressionBesoin()->getId()){
                $ctContenu->setDebutNumero(NULL);
                $ctContenu->setFinNumero(NULL);
            }

            $ctContenuRepository->add($ctContenu, true);

            $this->addFlash("success", "Ajout d'imprimé relative à ce numéro est effectué avec succès.");

            return $this->redirectToRoute('contenu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_contenu/new.html.twig', [
            'ct_contenu' => $ctContenu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="contenu_show", methods={"GET"})
     */
    public function show(CtContenu $ctContenu): Response
    {
        return $this->render('ct_contenu/show.html.twig', [
            'ct_contenu' => $ctContenu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contenu_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtContenu $ctContenu, CtContenuRepository $ctContenuRepository): Response
    {
        $form = $this->createForm(CtContenuType::class, $ctContenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctContenuRepository->add($ctContenu, true);

            $this->addFlash("success", "Modification d'imprimé relative à ce numéro est effectuée avec succès.");

            return $this->redirectToRoute('contenu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_contenu/edit.html.twig', [
            'ct_contenu' => $ctContenu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="contenu_delete", methods={"POST"})
     */
    public function delete(Request $request, CtContenu $ctContenu, CtContenuRepository $ctContenuRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctContenu->getId(), $request->request->get('_token'))) {
            $ctContenuRepository->remove($ctContenu, true);

            $this->addFlash("success", "Suppression d'imprimé relative à ce numéro est effectuée avec succès.");
        }

        return $this->redirectToRoute('contenu_index', [], Response::HTTP_SEE_OTHER);
    }
}
