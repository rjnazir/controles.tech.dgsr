<?php

namespace App\Controller;

use TCPDF;
use App\Entity\CtBordereau;
use App\Entity\CtContenu;
use App\Form\CtBordereauType;
use App\Repository\CtCentreRepository;
use App\Repository\CtContenuRepository;
use App\Repository\CtBordereauRepository;
use App\Repository\CtExpressionBesoinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;

/**
 * @Route("be")
 */
class CtBordereauController extends AbstractController
{
    /**
     * @Route("/", name="be_index", methods={"GET"})
     */
    public function index(CtBordereauRepository $ctBordereauRepository): Response
    {
        // return $this->render('ct_bordereau/index.html.twig', [
        //     'ct_bordereaus' => $ctBordereauRepository->findAll(),
        // ]);
        return $this->render(
            'ct_bordereau/index.html.twig',[
                'ct_bordereaus' => $ctBordereauRepository->findBy(
                    [],
                    ['id' => 'DESC']
                ),
            ]
        );
    }

    /**
     * @Route("/new", name="be_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CtBordereauRepository $ctBordereauRepository): Response
    {
        $ctCentre = $this->getUser()->getCtCentre()->getId();

        $ctBordereau = new CtBordereau();
        $form = $this->createForm(CtBordereauType::class, $ctBordereau, ['idCentre'=>$ctCentre]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctBordereau->setBeCreatedAt(new DateTimeImmutable());
            $ctBordereau->setUser($this->getUser());

            $ctBordereauRepository->add($ctBordereau, true);

            $this->addFlash("success", "Ajout du bordereau effectué avec succès.");

            return $this->redirectToRoute('be_show', ['id'=>$ctBordereau->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_bordereau/new.html.twig', [
            'ct_bordereau' => $ctBordereau,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="be_show", methods={"GET"})
     */
    public function show(CtBordereau $ctBordereau, CtContenuRepository $ctContenuRepository): Response
    {
        return $this->render('ct_bordereau/show.html.twig', [
            'ct_bordereau' => $ctBordereau,
            'ct_contenus' => $ctContenuRepository->findBy(['ctExpressionBesoin'=>$ctBordereau->getCtExpressionBesoin()], ['id'=>'ASC']),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="be_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, CtBordereau $ctBordereau, CtBordereauRepository $ctBordereauRepository): Response
    {
        $ctCentre = $this->getUser()->getCtCentre()->getId();

        $form = $this->createForm(CtBordereauType::class, $ctBordereau, ['idCentre'=>$ctCentre]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ctBordereau->setBeUpdatedAt(new DateTimeImmutable());
            $ctBordereau->setUser($this->getUser());
            $ctBordereauRepository->add($ctBordereau, true);

            $this->addFlash("success", "Modification du bordereau effectué avec succès.");

            return $this->redirectToRoute('be_show', ['id'=>$ctBordereau->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ct_bordereau/edit.html.twig', [
            'ct_bordereau' => $ctBordereau,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="be_delete", methods={"POST"})
     */
    public function delete(Request $request, CtBordereau $ctBordereau, CtBordereauRepository $ctBordereauRepository, CtContenuRepository $ctContenuRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ctBordereau->getId(), $request->request->get('_token'))) {

            // Annulation des valeurs dans la table contenu lié au bordereau en question
            $ctContenuRepository->updateCtContenuForDropBordereau($ctBordereau->getId());

            $ctBordereauRepository->remove($ctBordereau, true);

            $this->addFlash("success", "Suppression du bordereau effectué avec succès.");
        }

        return $this->redirectToRoute('be_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/printing/{id}", name="be_print")
     */
    public function printing(CtBordereau $ctBordereau, CtBordereauRepository $ctBordereauRepository, CtCentreRepository $ctCentreRepository, CtContenuRepository $ctContenuRepository, CtExpressionBesoinRepository $ctExpressionBesoinRepository)
    {
        $dir_be_generated = $ctExpressionBesoinRepository->getDirGeneratedPdf('be');
        $numero_be = $ctBordereauRepository->findOneBy(['id'=>$ctBordereau->getId()]);
        if($numero_be) $numero = $numero_be->getBeNumero();

        // $ct_centre  = $this->getUser()->getCtCentre()->getCtrNom();
        $ct_centre  = $numero_be->getCtCentre()->getCtrNom();
        $rgts_ctre  = $ctCentreRepository->transformCenter($ct_centre);
        $ctrFonction= $rgts_ctre[0];
        $ctrNom     = mb_strtoupper($rgts_ctre[1]);
        $ctrLibelle = mb_strtoupper($rgts_ctre[2]);
        $ctrAbbrev  = $rgts_ctre[3];

        $contenue = $ctContenuRepository->findBy(['ctBordereau'=>$ctBordereau->getId()]);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage('P');
        $pdf->SetTitle('Bordereau d\'envoi');

        $pdf->SetPrintHeader(false);
        $pdf->SetHeaderFont(array('times', '', 10));
		$pdf->SetHeaderMargin(10);
        $pdf->SetHeaderData(array(0,0,0), array(255,255,255));

        $pdf->SetPrintFooter(true);
		$pdf->SetFooterFont(Array('times', '', 10));
		$pdf->SetFooterMargin(10);
        $pdf->SetFooterData(array(0,0,0), array(255,255,255));
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
		$pdf->MultiCell(95,5,"DIRECTION ADMINISTRATIVE ET FINANCIERE",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"" ,0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->SetFont('times','B',9);
		$pdf->MultiCell(95,5,"SERVICE FINANCIER ET BUDGET",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->SetFont('times','',9);
		$pdf->MultiCell(95,5, ('A '.ucwords(strtolower('ALAROBIA')).', '.$ctCentreRepository->dateLetterFr()),0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
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
		$pdf->Cell(190,8,"BORDEREAU D'ENVOI",0,0,'C');
		$pdf->Ln(15);

		$entete = array();
		$entete[0] = "N°";
		$entete[1] = "DESIGNATION DES PIECES";
		$entete[2] = "QUANTITE DEMANDER";
		$entete[3] = "NUMERO DE SERIE";
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
				$pdf->Cell($w[1],12,'- '.$contenue->getCtImprimeTech()->getNomImprimeTech().' ('.$contenue->getCtImprimeTech()->getAbrevImprimeTech().')',1);
				$pdf->Cell($w[2],12,$contenue->getQteDemande(),1,0,'C');
				$pdf->Cell($w[3],12,(($contenue->getDebutNumero() and $contenue->getFinNumero()) ? $contenue->getDebutNumero().' à '. $contenue->getFinNumero():"-"),1,0,'C');
				$pdf->Cell($w[4],12,"",1,0,'C');
				$pdf->Ln(12);
                $i++;
			}
		}else{
			$pdf->Cell(190,12,"NEANT",1,0,"C");
			$pdf->Ln(12);
		}

        //Signataire et avis du BE
		// $pdf->SetTextColor(0, 0, 0);
		// $pdf->SetFont('times', '', 12);
        // $pdf->Cell(95, 12, '', 0, 0, 'C');
        // $pdf->Cell(95, 12, str_replace('LE ', '', $ctrFonction), 0, 1, 'C');
        // $pdf->Cell(95, 12, $ctrFonction, 0, 1, 'C');
        // $pdf->Ln(40);
		// $pdf->SetFont('times', 'UB', 12);
        // $pdf->Cell(95, 12, mb_strtoupper('Avis du responsable MAG.APPRO'), 0, 0, 'C');
        // $pdf->Cell(95, 12, mb_strtoupper('Décision AC'), 0, 1, 'C');

        $pdf->SetY(-15);
        $pdf->setFont('times', 'I', 6);
        $pdf->Cell(0, 5, 'Editée le ' . date('d/m/Y') .' à ' . date('H:i:s') . ' par ' . $this->getUser()->getUsrnamecomplet() , 0, 0, 'L');

        $pdf->Output($dir_be_generated.'be_'.strtolower($ctrAbbrev).'_'.date('YmdHis').'.pdf', 'FI');

    }
}
