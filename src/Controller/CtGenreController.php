<?php

namespace App\Controller;

use App\Entity\CtGenre;
use App\Form\CtGenreType;
use App\Repository\CtGenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gr")
 */
class CtGenreController extends AbstractController
{
    /**
     * @Route("/", name="gr_index", methods={"GET"})
     */
    public function index(CtGenreRepository $ctGenreRepository): Response
    {
        return $this->render('ct_genre/index.html.twig', [
            'ct_genres' => $ctGenreRepository->findBy([], ['id' => 'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="gr_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtGenreRepository $ctGenreRepository): Response
    {
        $ctGenre = new CtGenre();
        $form = $this->createForm(CtGenreType::class, $ctGenre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctGenreRepository->add($ctGenre, true);

            $this->addFlash("success", "Ajout de genre affectué avec succès.");

            return $this->redirectToRoute('gr_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_genre/new.html.twig', [
            'ct_genre' => $ctGenre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="gr_show", methods={"GET"})
     */
    public function show(CtGenre $ctGenre): Response
    {
        return $this->render('ct_genre/show.html.twig', [
            'ct_genre' => $ctGenre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gr_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtGenre $ctGenre, CtGenreRepository $ctGenreRepository): Response
    {
        $form = $this->createForm(CtGenreType::class, $ctGenre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctGenreRepository->add($ctGenre, true);

            $this->addFlash("success", "Modification de genre affectuée avec succès.");

            return $this->redirectToRoute('gr_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_genre/edit.html.twig', [
            'ct_genre' => $ctGenre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="gr_delete", methods={"POST"})
     */
    public function delete(Request $request, CtGenre $ctGenre, CtGenreRepository $ctGenreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctGenre->getId(), $request->request->get('_token'))) {
            $ctGenreRepository->remove($ctGenre, true);
            
            $this->addFlash("success", "Suppression de genre affectuée avec succès.");

        }

        return $this->redirectToRoute('gr_index', [], Response::HTTP_SEE_OTHER);
    }
}
