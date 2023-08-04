<?php

namespace App\Controller;

use TCPDF;
use DateTime;
use DateTimeImmutable;
use App\Form\CtContenuType;
use App\Entity\CtContenu;
use App\Entity\CtExpressionBesoin;
use App\Form\CtExpressionBesoinType;
use App\Repository\CtCentreRepository;
use App\Repository\CtContenuRepository;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CtExpressionBesoinRepository;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $form = $this->createForm(CtExpressionBesoinType::class, $ctExpressionBesoin, ['ctCentre'=>$ctCentre]);

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
        $ctCentre = $this->getUser()->getCtCentre()->getId();

        $form = $this->createForm(CtExpressionBesoinType::class, $ctExpressionBesoin, ['ctCentre' => $ctCentre]);
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
     * @Route("/printing/{id}", name="edb_print")
     */
    public function printing(CtExpressionBesoin $ctExpressionBesoin, CtExpressionBesoinRepository $ctExpressionBesoinRepository, CtCentreRepository $ctCentreRepository, CtContenuRepository $ctContenuRepository)
    {
        $dir_edb_generated = $ctExpressionBesoinRepository->getDirGeneratedPdf('edb');
        $numero_edb = $ctExpressionBesoinRepository->findOneBy(['id'=>$ctExpressionBesoin->getId()]);
        if($numero_edb) $numero = $numero_edb->getEdbNumero();

        $ct_centre  = $this->getUser()->getCtCentre()->getCtrNom();
        $rgts_ctre  = $ctCentreRepository->transformCenter($ct_centre);
        $ctrFonction= $rgts_ctre[0];
        $ctrNom     = mb_strtoupper($rgts_ctre[1]);
        $ctrLibelle = mb_strtoupper($rgts_ctre[2]);
        $ctrAbbrev  = $rgts_ctre[3];

        $contenue = $ctContenuRepository->findBy(['ctExpressionBesoin'=>$ctExpressionBesoin->getId()]);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage('P');
        $pdf->SetTitle('Expression de besoin');

        $pdf->setPrintHeader(false);
		$pdf->SetHeaderMargin(0);

        $pdf->setPrintFooter(true);
		$pdf->SetFooterFont(Array('times', '', 10));
		$pdf->SetFooterMargin(10);
        $pdf->SetFooterData(array(0,0,0), array(0,0,0));
		$pdf->SetAutoPageBreak(true, 10);
        
        $pdf->SetFont('times','',9);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(0,0,0,0);
		$pdf->MultiCell(95,5,"DIRECTION GENERALE DE LA SECURITE ROUTIERE",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"REPOBLIKAN'I MADAGASIKARA",0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->SetFont('times','I',9);
		$pdf->MultiCell(95,5,"Fitiavana - Tanindrazana - Fandrosoana",0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->SetFont('times','',9);
		$pdf->MultiCell(95,5,"DIRECTION DES OPERATIONS ROUTIERES",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"" ,0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->SetFont('times','B',9);
		$pdf->MultiCell(95,5,$ctrLibelle.' '.$ctrNom,0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->SetFont('times','',9);
		$pdf->MultiCell(95,5, ('A '.ucwords(strtolower($ctrNom)).', '.$ctCentreRepository->dateLetterFr()),0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,$numero,0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
        $pdf->SetXY(52.5, 40);
        $pdf->Image('sb-admin-2/images/logo_dgsr.jpg', '', '', 10, 10, '', '', '', true, 300, '', false, false, false, false, false, false);
		$pdf->Ln(10);
		$pdf->SetFont('times','',7);
		$pdf->MultiCell(95,5,"LAHITOKANA NY AINA",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"",0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->Ln(8);


		$pdf->SetFont('times','UB',14);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(190,8,"EXPRESSION DES BESOINS",0,0,'C');
		$pdf->Ln(15);

		$entete = array();
		$entete[0] = "N°";
		$entete[1] = "DESIGNATION DES PIECES";
		$entete[2] = "QUANTITE EN STOCKS";
		$entete[3] = "QUANTITE DEMANDER";
		$entete[4] = "OBSERVATIONS";
		$pdf->SetTextColor(0,0,0);
		//En-tête tableau
		$pdf->SetFont('times','B',12);
		$w=array(10,75,34,34,37);
		$pdf->SetFillColor(255,255,255);
		for($i=0;$i<count($entete);$i++){
            if($i< (count($w) - 1 )){
                $pdf->MultiCell($w[$i], 12, $entete[$i], 1, 'C', 1, 0, '', '', true, 0, false, true, 12, 'M');
            }else{
                $pdf->MultiCell($w[$i], 12, $entete[$i], 1, 'C', 1, 1, '', '', true, 0, false, true, 12, 'M');
            }
		}
        //Contenu du tablau
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('times','',12);
		if(count($contenue) !=0){
            $i = 1;
			foreach($contenue as $contenue) {
				$pdf->Cell($w[0],12,$i,1,0,'C');
				$pdf->Cell($w[1],12,$contenue->getCtImprimeTech()->getNomImprimeTech().' ('.$contenue->getCtImprimeTech()->getAbrevImprimeTech().')',1);
				$pdf->Cell($w[2],12,"",1,0,'C');
				$pdf->Cell($w[3],12,$contenue->getQteDemande(),1,0,'C');
				$pdf->Cell($w[4],12,"",1,0,'C');
				$pdf->Ln(12);
                $i++;
			}
		}else{
			$pdf->Cell(190,12,"NEANT",1,0,"C");
			$pdf->Ln(12);
		}

        //Signataire et avis de l'EDB
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('times', '', 12);
        $pdf->Cell(95, 12, '', 0, 0, 'C');
        // $pdf->Cell(95, 12, str_replace('LE ', '', $ctrFonction), 0, 1, 'C');
        $pdf->Cell(95, 12, $ctrFonction, 0, 1, 'C');
        $pdf->Ln(40);
		$pdf->SetFont('times', 'UB', 12);
        $pdf->Cell(95, 12, mb_strtoupper('Avis du responsable MAG.APPRO'), 0, 0, 'C');
        $pdf->Cell(95, 12, mb_strtoupper('Décision AC'), 0, 1, 'C');

        $pdf->SetY(-15);
        $pdf->setFont('times', 'I', 6);
        $pdf->Cell(0, 5, 'Editée le ' . date('d/m/Y') .' à ' . date('H:i:s') . ' par ' . $this->getUser()->getUsrnamecomplet() , 0, 0, 'L');

        $pdf->Output($dir_edb_generated.'edb_'.strtolower($ctrAbbrev).'_'.date('YmdHis').'.pdf', 'FI');

    }

    /**
    *   @Route("/print_docx/{id}", name="edb_print_docx")
    */
    public function printing_docx(CtExpressionBesoin $ctExpressionBesoin, CtExpressionBesoinRepository $ctExpressionBesoinRepository, CtCentreRepository $ctCentreRepository, CtContenuRepository $ctContenuRepository):Response
    {
        //Rgts centre établissant l'edb
        $ct_centre  = $this->getUser()->getCtCentre()->getCtrNom();
        $rgts_ctre  = $ctCentreRepository->transformCenter($ct_centre);

        // Chemin vers le template Word
        $templatePath   = $ctExpressionBesoinRepository->getFileTemplateDocx('edb');

        // Créez un TemplateProcessor en utilisant le template
        $templateProcessor  = new TemplateProcessor($templatePath);

        // Completement de l'attache du centre
        $templateProcessor->setValue('centre', mb_strtoupper($rgts_ctre[2] .' ' . $rgts_ctre[1]));

        // Lieu et date edition de l'edb
        $templateProcessor->setValue('lieu', ucwords(strtolower($rgts_ctre[1])));
        $edbdate    = $ctCentreRepository->dateLetterFr();
        $templateProcessor->setValue('edbDate', $edbdate);

        // Récupération numéro de l'edb
        $numero_edb = $ctExpressionBesoinRepository->findOneBy(['id'=>$ctExpressionBesoin->getId()]);
        $numero     = $numero_edb ? $numero_edb->getEdbNumero() : "N°_______-CENSERO/";
        $templateProcessor->setValue('numeroedb', ucwords($numero));

        // Remplacez les placeholders dans le template
        $contenues  = $ctContenuRepository->findBy(['ctExpressionBesoin'=>$ctExpressionBesoin->getId()]);
        $nbrecntns  = count($contenues);
        $_i = 1;
        $_k = 0;

        $templateProcessor->cloneRow('i', $nbrecntns);
        foreach($contenues as $contenues){
            ++$_k;
            $templateProcessor->setValue('i#'.$_k, $_i);
            $templateProcessor->setValue('typeImprime#'.$_k, $contenues->getCtImprimeTech()->getNomImprimeTech().' ('.$contenues->getCtImprimeTech()->getAbrevImprimeTech().')');
            $templateProcessor->setValue('enstock#'.$_k, null);
            $templateProcessor->setValue('qtedder#'.$_k, $contenues->getQteDemande());
            $_i++;
        }

        // Compléter fonction du signataire
        $templateProcessor->setValue('signataire', $rgts_ctre[0]);
        
        // Compléter le pied de page (Date d'edition et utilisateur)
        $templateProcessor->setValue('printdate', date('d/m/Y') .' à ' . date('H:i:s'));
        $templateProcessor->setValue('usrprinter', $this->getUser()->getUsrnamecomplet());

        // Générez le fichier Word
        $fileName = 'edb_'. strtolower($rgts_ctre[3]) . '_' . date('YmdHis') .'.docx';
        $filePath = $ctExpressionBesoinRepository->getDirGeneratedPdf('edb') . $fileName;
        $templateProcessor->saveAs($filePath);

        // Renvoyez une réponse pour télécharger le fichier généré
        $response = new Response(file_get_contents($filePath));
        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            $fileName
        );
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}