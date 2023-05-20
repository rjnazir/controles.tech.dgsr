<?php

namespace App\Controller;

use App\Entity\CtVisiteExtraTarif;
use App\Form\CtVisiteExtraTarifType;
use App\Repository\CtVisiteExtraTarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vet")
 */
class CtVisiteExtraTarifController extends AbstractController
{
    /**
     * @Route("/", name="vet_index", methods={"GET"})
     */
    public function index(CtVisiteExtraTarifRepository $ctVisiteExtraTarifRepository): Response
    {
        return $this->render('ct_visite_extra_tarif/index.html.twig', [
            'ct_visite_extra_tarifs' => $ctVisiteExtraTarifRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="vet_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtVisiteExtraTarifRepository $ctVisiteExtraTarifRepository): Response
    {
        $ctVisiteExtraTarif = new CtVisiteExtraTarif();
        $form = $this->createForm(CtVisiteExtraTarifType::class, $ctVisiteExtraTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vetAnnee = (string) $ctVisiteExtraTarif->getCtArretePrix()->getArtDateApplic()->format('Y');
            $ctVisiteExtraTarif->setVetAnnee($vetAnnee);

            $ctVisiteExtraTarifRepository->add($ctVisiteExtraTarif, true);

            $this->addFlash("success", "Ajout tarif visite extra est effectué avec succès.");

            return $this->redirectToRoute('vet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_visite_extra_tarif/new.html.twig', [
            'ct_visite_extra_tarif' => $ctVisiteExtraTarif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="vet_show", methods={"GET"})
     */
    public function show(CtVisiteExtraTarif $ctVisiteExtraTarif): Response
    {
        return $this->render('ct_visite_extra_tarif/show.html.twig', [
            'ct_visite_extra_tarif' => $ctVisiteExtraTarif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vet_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtVisiteExtraTarif $ctVisiteExtraTarif, CtVisiteExtraTarifRepository $ctVisiteExtraTarifRepository): Response
    {
        $form = $this->createForm(CtVisiteExtraTarifType::class, $ctVisiteExtraTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vetAnnee = (string) $ctVisiteExtraTarif->getCtArretePrix()->getArtDateApplic()->format('Y');
            $ctVisiteExtraTarif->setVetAnnee($vetAnnee);

            $ctVisiteExtraTarifRepository->add($ctVisiteExtraTarif, true);

            $this->addFlash("success", "Modification tarif visite extra est effectuée avec succès.");

            return $this->redirectToRoute('vet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_visite_extra_tarif/edit.html.twig', [
            'ct_visite_extra_tarif' => $ctVisiteExtraTarif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="vet_delete", methods={"POST"})
     */
    public function delete(Request $request, CtVisiteExtraTarif $ctVisiteExtraTarif, CtVisiteExtraTarifRepository $ctVisiteExtraTarifRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctVisiteExtraTarif->getId(), $request->request->get('_token'))) {
            $ctVisiteExtraTarifRepository->remove($ctVisiteExtraTarif, true);

            $this->addFlash("success", "Suppression tarif visite extra est effectuée avec succès.");
        }

        return $this->redirectToRoute('vet_index', [], Response::HTTP_SEE_OTHER);
    }
}
