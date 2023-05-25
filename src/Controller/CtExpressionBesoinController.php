<?php

namespace App\Controller;

use DateTime;
use DateTimeImmutable;
use App\Entity\CtExpressionBesoin;
use App\Form\CtExpressionBesoinType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CtExpressionBesoinRepository;
use PhpOffice\PhpWord\PhpWord;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * @Route("/edb")
 */
class CtExpressionBesoinController extends AbstractController
{
    /**
     * @Route("/", name="edb_index", methods={"GET"})
     */
    public function index(CtExpressionBesoinRepository $ctExpressionBesoinRepository): Response
    {
        $ctCentre = $this->getUser()->getCtCentre();
        $edbDateEdit = new DateTime('now');
        return $this->render('ct_expression_besoin/index.html.twig', [
            'ct_expression_besoins' => $ctExpressionBesoinRepository->findBy(
                [
                    'ctCentre'=>$ctCentre,
                    'edbDateEdit'=>$edbDateEdit,
                ],
                ['id'=>'DESC']
            ),
        ]);
    }

    /**
     * @Route("/new", name="edb_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtExpressionBesoinRepository $ctExpressionBesoinRepository): Response
    {
        $ctCentre = $this->getUser()->getCtCentre()->getId();

        $ctExpressionBesoin = new CtExpressionBesoin();
        $form = $this->createForm(CtExpressionBesoinType::class, $ctExpressionBesoin, ['ctCentre' => $ctCentre]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctExpressionBesoin->setEdbCreatedAt(new DateTimeImmutable());
            $ctExpressionBesoin->setCtCentre($this->getUser()->getCtCentre());
            $ctExpressionBesoin->setUser($this->getUser());

            $ctExpressionBesoinRepository->add($ctExpressionBesoin, true);

            $this->addFlash("success", "Ajout de l'imprimé dans l'expression de besoin effectué avec succès.");

            return $this->redirectToRoute('edb_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_expression_besoin/new.html.twig', [
            'ct_expression_besoin' => $ctExpressionBesoin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="edb_show", methods={"GET"})
     */
    public function show(CtExpressionBesoin $ctExpressionBesoin): Response
    {
        return $this->render('ct_expression_besoin/show.html.twig', [
            'ct_expression_besoin' => $ctExpressionBesoin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edb_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtExpressionBesoin $ctExpressionBesoin, CtExpressionBesoinRepository $ctExpressionBesoinRepository): Response
    {
        $form = $this->createForm(CtExpressionBesoinType::class, $ctExpressionBesoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctExpressionBesoin->setEdbUpdatedAt(new DateTimeImmutable());
            $ctExpressionBesoin->setCtCentre($this->getUser()->getCtCentre());
            $ctExpressionBesoin->setUser($this->getUser());
            
            $ctExpressionBesoinRepository->add($ctExpressionBesoin, true);

            $this->addFlash("success", "Modification de l'imprimé dans l'expression de besoin effectuée avec succès.");

            return $this->redirectToRoute('edb_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_expression_besoin/edit.html.twig', [
            'ct_expression_besoin' => $ctExpressionBesoin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="edb_delete", methods={"POST"})
     */
    public function delete(Request $request, CtExpressionBesoin $ctExpressionBesoin, CtExpressionBesoinRepository $ctExpressionBesoinRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctExpressionBesoin->getId(), $request->request->get('_token'))) {
            $ctExpressionBesoinRepository->remove($ctExpressionBesoin, true);

            $this->addFlash("success", "Suppression de l'imprimé dans l'expression de besoin effectuée avec succès.");
        }

        return $this->redirectToRoute('edb_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/printing", name="edb_print")
     */
    public function printing(CtExpressionBesoinRepository $ctExpressionBesoinRepository)
    {
        $ctCentre = $this->getUser()->getCtCentre()->getId();
        $edbDateEdit = new DateTime('now');

        $contenue = $ctExpressionBesoinRepository->findBy(['ctCentre'=>$ctCentre, 'edbDateEdit'=>$edbDateEdit]);

        $fileName = "reporting/templates/edb/edb.docx";
    
        $_phpWord = new PhpWord();
        // ask the service for a Word2007
        // $phpTemplateObject = $this->get('phpword')->createTemplateObject($fileName);
        $phpTemplateObject = $_phpWord->createTemplateObject($fileName);

        $phpTemplateObject->setValue('test', 'testValue');
        $phpTemplateObject->setValue('idCentre', $ctCentre);
        $phpTemplateObject->setValue('edbDate', $edbDateEdit);
        
        // $phpWordObject = $this->get('phpword')->getPhpWordObjFromTemplate($phpTemplateObject);
        $phpWordObject = $_phpWord->getPhpWordObjFromTemplate($phpTemplateObject);

        // create the writer
        // $writer = $this->get('phpword')->createWriter($phpWordObject, 'Word2007');
        $writer = $_phpWord->createWriter($phpWordObject, 'Word2007');
        // create the response
        // $response = $this->get('phpword')->createStreamedResponse($writer);
        $response = $_phpWord->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'stream-file.docx'
        );
        $response->headers->set('Content-Type', 'application/msword');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
        // $ctCentre = $this->getUser()->getCtCentre()->getId();
        // $edbDateEdit = new DateTime('now');

        // $link = $ctExpressionBesoinRepository->generateEdb($ctCentre, $edbDateEdit);

        // return new JsonResponse($link);
    }
}
