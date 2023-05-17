<?php

namespace App\Controller;

use App\Entity\CtGenreCategorie;
use App\Form\CtGenreCategorieType;
use App\Repository\CtGenreCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct_gc")
 */
class CtGenreCategorieController extends AbstractController
{
    /**
     * @Route("/", name="ct_gc_index", methods={"GET"})
     */
    public function index(CtGenreCategorieRepository $ctGenreCategorieRepository): Response
    {
        return $this->render('ct_genre_categorie/index.html.twig', [
            'ct_genre_categories' => $ctGenreCategorieRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="ct_gc_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtGenreCategorieRepository $ctGenreCategorieRepository): Response
    {
        $ctGenreCategorie = new CtGenreCategorie();
        $form = $this->createForm(CtGenreCategorieType::class, $ctGenreCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctGenreCategorieRepository->add($ctGenreCategorie, true);

            $this->addFlash('success', 'Ajout de catégorie de genre est effectué avec succès.');

            return $this->redirectToRoute('ct_gc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_genre_categorie/new.html.twig', [
            'ct_genre_categorie' => $ctGenreCategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ct_gc_show", methods={"GET"})
     */
    public function show(CtGenreCategorie $ctGenreCategorie): Response
    {
        return $this->render('ct_genre_categorie/show.html.twig', [
            'ct_genre_categorie' => $ctGenreCategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ct_gc_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtGenreCategorie $ctGenreCategorie, CtGenreCategorieRepository $ctGenreCategorieRepository): Response
    {
        $form = $this->createForm(CtGenreCategorieType::class, $ctGenreCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctGenreCategorieRepository->add($ctGenreCategorie, true);

            $this->addFlash('success', 'Modification de catégorie de genre est effectuée avec succès.');

            return $this->redirectToRoute('ct_gc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_genre_categorie/edit.html.twig', [
            'ct_genre_categorie' => $ctGenreCategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ct_gc_delete", methods={"POST"})
     */
    public function delete(Request $request, CtGenreCategorie $ctGenreCategorie, CtGenreCategorieRepository $ctGenreCategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctGenreCategorie->getId(), $request->request->get('_token'))) {
            $ctGenreCategorieRepository->remove($ctGenreCategorie, true);

            $this->addFlash('success', 'Suppression de catégorie de genre est effectuée avec succès.');

        }

        return $this->redirectToRoute('ct_gc_index', [], Response::HTTP_SEE_OTHER);
    }
}
