<?php

namespace App\Controller;

use App\Entity\CtUsageTarif;
use App\Form\CtUsageTarifType;
use App\Repository\CtArretePrixRepository;
use App\Repository\CtUsageTarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/usage_tarif")
 */
class CtUsageTarifController extends AbstractController
{
    /**
     * @Route("/", name="usage_tarif_index", methods={"GET"})
     */
    public function index(CtUsageTarifRepository $ctUsageTarifRepository): Response
    {
        return $this->render('ct_usage_tarif/index.html.twig', [
            'ct_usage_tarifs' => $ctUsageTarifRepository->findBy([],['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="usage_tarif_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtUsageTarifRepository $ctUsageTarifRepository): Response
    {

        $ctUsageTarif = new CtUsageTarif();
        $form = $this->createForm(CtUsageTarifType::class, $ctUsageTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usgTrfAnnee = (string) $ctUsageTarif->getCtArretePrix()->getArtDateApplic()->format('Y');
            $ctUsageTarif->setUsgTrfAnnee($usgTrfAnnee);

            $ctUsageTarifRepository->add($ctUsageTarif, true);

            $this->addFlash('success', 'Ajout de tarif de l\'usage est effectué avec succès.');

            return $this->redirectToRoute('usage_tarif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_usage_tarif/new.html.twig', [
            'ct_usage_tarif' => $ctUsageTarif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="usage_tarif_show", methods={"GET"})
     */
    public function show(CtUsageTarif $ctUsageTarif): Response
    {
        return $this->render('ct_usage_tarif/show.html.twig', [
            'ct_usage_tarif' => $ctUsageTarif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="usage_tarif_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtUsageTarif $ctUsageTarif, CtUsageTarifRepository $ctUsageTarifRepository): Response
    {
        $form = $this->createForm(CtUsageTarifType::class, $ctUsageTarif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usgTrfAnnee = (string) $ctUsageTarif->getCtArretePrix()->getArtDateApplic()->format('Y');
            $ctUsageTarif->setUsgTrfAnnee($usgTrfAnnee);

            $ctUsageTarifRepository->add($ctUsageTarif, true);

            $this->addFlash('success', 'Modification de tarif de l\'usage est effectué avec succès.');

            return $this->redirectToRoute('usage_tarif_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_usage_tarif/edit.html.twig', [
            'ct_usage_tarif' => $ctUsageTarif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="usage_tarif_delete", methods={"POST"})
     */
    public function delete(Request $request, CtUsageTarif $ctUsageTarif, CtUsageTarifRepository $ctUsageTarifRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctUsageTarif->getId(), $request->request->get('_token'))) {
            $ctUsageTarifRepository->remove($ctUsageTarif, true);

            $this->addFlash('success', 'Suppression de tarif de l\'usage est effectué avec succès.');
        }

        return $this->redirectToRoute('usage_tarif_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route ("/tarif_usage_by_id", name="annee_arrete_prix_by_tarif_usage", methods={"GET", "POST"})
     */
    public function recupUsgTrfAnnee(Request $request, CtUsageTarifRepository $ctUsageTarifRepository):string
    {
        $_data = $request->request->all();
        $arrete_prix_id = array_key_exists('ctArretePrix', $_data) ? $_data['ctArretePrix'] : 0;

        if($arrete_prix_id > 0){
            $_arretes = $ctUsageTarifRepository->findBy(['id'=> $arrete_prix_id]);
            foreach ($_arretes as $_arrete) {
                $_usgTrfAnnee   = $_arrete->getCtArretePrix()->getArtDateApplic()->format('Y');
            }
        } else {
            $_usgTrfAnnee       = "Erreur arrêté";
        }

        return $_usgTrfAnnee;
    }

    /**
     * @Route ("/annee_arrete_prix", name="annee_arrete_prix_by_id", methods={"GET", "POST"})
     */
    public function recupUsgTrfAnneev2(int $id, CtArretePrixRepository $_art):string
    {
        if($id > 0){
            $_arretes = $_art->findBy($id);
            foreach ($_arretes as $_arrete) {
                $_usgTrfAnnee   = $_arrete->getArtDateApplic()->format('Y');
            }
        } else {
            $_usgTrfAnnee       = "Erreur arrêté";
        }

        return $_usgTrfAnnee;
    }
}
