<?php

namespace App\Controller;

use App\Entity\CtMotifTarif;
use App\Form\CtMotifTarifType;
use App\Repository\CtMotifTarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct_motif_tarif")
 */
class CtMotifTarifController extends AbstractController
{
    /**
     * @Route("/", name="app_ct_motif_tarif_index", methods={"GET"})
     */
    public function index(CtMotifTarifRepository $ctMotifTarifRepository): Response
    {
        return $this->render('ct_motif_tarif/index.html.twig', [
            'ct_motif_tarifs' => $ctMotifTarifRepository->findBy([],['id' => 'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="app_ct_motif_tarif_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtMotifTarifRepository $ctMotifTarifRepository): Response
    {
        $ctMotifTarif = new CtMotifTarif();
        $form = $this->createForm(CtMotifTarifType::class, $ctMotifTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mtfTrfDate = (string) $ctMotifTarif->getCtArretePrix()->getArtDateApplic()->format('Y');
            $ctMotifTarif->setMtfTrfDate($mtfTrfDate);

            $test   = $ctMotifTarifRepository->countByArreteMotifDate(
                        $ctMotifTarif->getCtArretePrix()->getId(),
                        $ctMotifTarif->getCtMotif()->getId(),
                        $mtfTrfDate
                    );

            if(count($test) > 0){
                $this->addFlash('error', 'Le tarif du motif entré est déjà existant.');
            }else{
                $ctMotifTarifRepository->add($ctMotifTarif, true);

                $this->addFlash('success', 'Ajout de tarif du motif effectuée avec succès.');

                return $this->redirectToRoute('app_ct_motif_tarif_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('ct_motif_tarif/new.html.twig', [
            'ct_motif_tarif' => $ctMotifTarif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ct_motif_tarif_show", methods={"GET"})
     */
    public function show(CtMotifTarif $ctMotifTarif): Response
    {
        return $this->render('ct_motif_tarif/show.html.twig', [
            'ct_motif_tarif' => $ctMotifTarif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ct_motif_tarif_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtMotifTarif $ctMotifTarif, CtMotifTarifRepository $ctMotifTarifRepository): Response
    {
        $form = $this->createForm(CtMotifTarifType::class, $ctMotifTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mtfTrfDate = (string) $ctMotifTarif->getCtArretePrix()->getArtDateApplic()->format('Y');
            $ctMotifTarif->setMtfTrfDate($mtfTrfDate);

            $test   = $ctMotifTarifRepository->countByArreteMotifDate(
                        $ctMotifTarif->getCtArretePrix()->getId(),
                        $ctMotifTarif->getCtMotif()->getId(),
                        $mtfTrfDate
                    );
            if(count($test) > 0){
                $this->addFlash('error', 'Le tarif du motif entré est déjà existant.');
            }else{
                $ctMotifTarifRepository->add($ctMotifTarif, true);

                $this->addFlash('success', 'Modification de tarif du motif effectuée avec succès.');

                return $this->redirectToRoute('app_ct_motif_tarif_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('ct_motif_tarif/edit.html.twig', [
            'ct_motif_tarif' => $ctMotifTarif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ct_motif_tarif_delete", methods={"POST"})
     */
    public function delete(Request $request, CtMotifTarif $ctMotifTarif, CtMotifTarifRepository $ctMotifTarifRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctMotifTarif->getId(), $request->request->get('_token'))) {
            $ctMotifTarifRepository->remove($ctMotifTarif, true);

            $this->addFlash('success', 'Suppression de tarif du motif effectuée avec succès.');

        }

        return $this->redirectToRoute('app_ct_motif_tarif_index', [], Response::HTTP_SEE_OTHER);
    }
}
