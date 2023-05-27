<?php

namespace App\Controller;

use DateTime;
use DateTimeImmutable;
use App\Entity\CtExpressionBesoin;
use App\Form\CtExpressionBesoinType;
use App\Repository\CtCentreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CtExpressionBesoinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use TCPDF;

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
     * @Route("/edb/printing", name="edb_print")
     */
    public function printing(CtExpressionBesoinRepository $ctExpressionBesoinRepository, CtCentreRepository $ctCentreRepository)
    {
        $ctCentre = $this->getUser()->getCtCentre()->getId();
        $edbDateEdit = new DateTime('now');

        $ct_centre = $this->getUser()->getCtCentre()->getCtrNom();
        $rgts_ctre = $ctCentreRepository->transformCenter($ct_centre, '69');
        $ctrFonction = $rgts_ctre[0];
        $ctrNom = $rgts_ctre[1];
        $ctrLibelle = $rgts_ctre[2];
        $ctrNumero = $rgts_ctre[4];

        $contenue = $ctExpressionBesoinRepository->findBy(['ctCentre'=>$ctCentre, 'edbDateEdit'=>$edbDateEdit]);
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage('P');
        $pdf->setTitle('Expression de besoin');

		$pdf->setPrintFooter(false);
		$pdf->setPrintHeader(false);
		$pdf->setFooterFont(Array('times', '', 10));
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);
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
		$pdf->MultiCell(95,5,'A '.ucwords(strtolower($ctrNom)).', '.$ctCentreRepository->dateLetterFr(),0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,$ctrNumero,0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
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
				$pdf->Cell($w[3],12,$contenue->getEdbQteDemander(),1,0,'C');
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
        $pdf->Cell(95, 12, ucfirst(strtolower(str_replace('LE ', '', $ctrFonction))), 0, 1, 'C');
        $pdf->Ln(40);
		$pdf->SetFont('times', 'UB', 12);
        $pdf->Cell(95, 12, 'Avis du responsable MAG.APPRO', 0, 0, 'C');
        $pdf->Cell(95, 12, 'Décision AC', 0, 1, 'C');

        $pdf->Output('edb_'.date('YmdHis').'.pdf', 'I');

    }
}
