<?php

namespace App\Controller;

use App\Entity\CtProvince;
use App\Form\CtProvinceType;
use App\Repository\CtProvinceRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ct_province")
 */
class CtProvinceController extends AbstractController
{
    /**
     * @Route("/", name="app_ct_province_index", methods={"GET"})
     */
    public function index(CtProvinceRepository $ctProvinceRepository): Response
    {
        return $this->render('ct_province/index.html.twig', [
            'provinces'  => $ctProvinceRepository->findBy([], ['id' => 'DESC']),

        ]);
    }

    /**
     * @Route("/new", name="app_ct_province_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtProvinceRepository $ctProvinceRepository): Response
    {
        $ctProvince = new CtProvince();
        $form = $this->createForm(CtProvinceType::class, $ctProvince);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ctProvince->setPrvCreatedAt(new DateTimeImmutable());
            $ctProvince->setPrvUpdatedAt(NULL);

            $ctProvinceRepository->add($ctProvince, true);

            $this->addFlash('success', 'Ajout de province effectué avec succès.');

            return $this->redirectToRoute('app_ct_province_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_province/new.html.twig', [
            'ct_province' => $ctProvince,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ct_province_show", methods={"GET"})
     */
    public function show(CtProvince $ctProvince): Response
    {
        return $this->render('ct_province/show.html.twig', [
            'ct_province' => $ctProvince,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ct_province_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtProvince $ctProvince, CtProvinceRepository $ctProvinceRepository): Response
    {
        $form = $this->createForm(CtProvinceType::class, $ctProvince);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ctProvince->setPrvUpdatedAt(new DateTimeImmutable());

            $ctProvinceRepository->add($ctProvince, true);

            $this->addFlash('success', 'Modification de province effectué avec succès.');

            return $this->redirectToRoute('app_ct_province_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_province/edit.html.twig', [
            'ct_province' => $ctProvince,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ct_province_delete", methods={"POST"})
     */
    public function delete(Request $request, CtProvince $ctProvince, CtProvinceRepository $ctProvinceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctProvince->getId(), $request->request->get('_token'))) {
            $ctProvinceRepository->remove($ctProvince, true);

            $this->addFlash('success', 'Suppression de province effectué avec succès.');
        }

        return $this->redirectToRoute('app_ct_province_index', [], Response::HTTP_SEE_OTHER);
    }
}
