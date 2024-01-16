<?php

namespace App\Controller;

use DateTime;
use DateTimeImmutable;
use App\Entity\CtContenu;
use App\Entity\CtExpressionBesoin;
use App\Form\CtContenu2Type;
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
        $id_edb = $ctExpressionBesoinRepository->findOneBy(['ctCentre' => $ctCentre, 'edbDateEdit' => $edbDateEdit]);
        return $this->render('ct_contenu/index.html.twig', [
            'ct_contenus' => $ctContenuRepository->contenuWithCentreDate($ctCentre, $edbDateEdit->format('Y-m-d')),
            'idEdb' => $id_edb ? $id_edb->getId() : NULL,
        ]);
    }

    /**
     * @Route("/list", name="be_contenu_index", methods={"GET"})
     */
    public function list(Request $request, CtContenuRepository $ctContenuRepository): Response
    {
        $ctExpressionBesoinRepository = $this->getDoctrine()->getManager()->getRepository(CtExpressionBesoin::class);
        $ctExpressionBesoin = $request->query->get('ctExpressionBesoin');
        $id_edb = $ctExpressionBesoinRepository->findOneBy(['id'=>$ctExpressionBesoin]);
        return $this->render('ct_contenu/list.html.twig', [
            'ct_contenus' => $ctContenuRepository->findBy(['ctExpressionBesoin'=>$ctExpressionBesoin], ['id'=>'ASC']),
            'idEdb' => $id_edb ? $id_edb->getId() : NULL,
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

        //recupération identifiant EDB concernée
        $_id = $request->query->get('id');

        if ($form->isSubmitted() && $form->isValid()) {
            if($ctContenu->getCtExpressionBesoin()->getId()){
                $ctContenu->setDebutNumero(NULL);
                $ctContenu->setFinNumero(NULL);
            }

            $ctContenuRepository->add($ctContenu, true);

            $this->addFlash("success", "Ajout d'imprimé relative à ce numéro est effectué avec succès.");

            // return $this->redirectToRoute('contenu_index', [], Response::HTTP_SEE_OTHER);

            return $this->redirectToRoute('edb_show', ['id' => $ctContenu->getCtExpressionBesoin()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_contenu/new.html.twig', [
            'ct_contenu' => $ctContenu,
            'form' => $form,
            'id' => $_id,
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

            // return $this->redirectToRoute('contenu_index', [], Response::HTTP_SEE_OTHER);
            return $this->redirectToRoute('edb_show', ['id' => $ctContenu->getCtExpressionBesoin()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_contenu/edit.html.twig', [
            'ct_contenu' => $ctContenu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit2", name="contenu_edit2", methods={"GET", "POST"})
     */
    public function edit2(Request $request, CtContenu $ctContenu, CtContenuRepository $ctContenuRepository): Response
    {
        $form = $this->createForm(CtContenu2Type::class, $ctContenu);
        $form->handleRequest($request);

        $ctBordereau = $request->query->get('ctBordereau');

        if ($form->isSubmitted() && $form->isValid()) {
            $ctContenuRepository->add($ctContenu, true);

            $this->addFlash("success", "Modification d'imprimé relative à ce numéro est effectuée avec succès.");

            return $this->redirectToRoute('be_show', ['id' => $ctBordereau], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_contenu/edit2.html.twig', [
            'ct_contenu' => $ctContenu,
            'ct_bordereau' => $ctBordereau,
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

        // return $this->redirectToRoute('contenu_index', [], Response::HTTP_SEE_OTHER);
        return $this->redirectToRoute('edb_show', ['id' => $ctContenu->getCtExpressionBesoin()->getId()], Response::HTTP_SEE_OTHER);
    }
}
