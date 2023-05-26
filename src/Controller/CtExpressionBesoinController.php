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
        $ctrLibelle = $rgts_ctre[2];
        $ctrNom = $rgts_ctre[1];
        $ctrNumero = $rgts_ctre[4];

        $contenue = $ctExpressionBesoinRepository->findBy(['ctCentre'=>$ctCentre, 'edbDateEdit'=>$edbDateEdit]);
        
        $pdf = new TCPDF();

        $pdf->AddPage('P');
        $pdf->setTitle('Expression de besoin');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetFont('helvetica','',7);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFillColor(0,0,0,0);
		$pdf->MultiCell(95,5,"DIRECTION GENERALE DE LA SECURITE ROUTIERE",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"REPOBLIKAN'I MADAGASIKARA",0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->SetFont('helvetica','I',7);
		$pdf->MultiCell(95,5,"Fitiavana - Tanindrazana - Fandrosoana",0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->SetFont('helvetica','',7);
		$pdf->MultiCell(95,5,"DIRECTION DES OPERATIONS ROUTIERES",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"" ,0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,$ctrLibelle.' '.$ctrNom,0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,'A '.ucwords(strtolower($ctrNom)).', '.$ctCentreRepository->dateLetterFr(),0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,"--------------------",0,'C',true,0,'', '', true, 0, false, true, 5, 'M');
		$pdf->MultiCell(95,5,$ctrNumero,0,'C',true,1,'', '', true, 0, false, true, 5, 'M');
		$pdf->Ln(10);

		$pdf->SetFont('Helvetica','UB',12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(190,8,"EXPRESSION DES BESOINS",0,0,'C');
		$pdf->Ln(10);

		$entete = array();
		$entete[0] = "N°";
		$entete[1] = "DESIGNATION DES PIECES";
		$entete[2] = "QUANTITE EN STOCKS";
		$entete[3] = "QUANTITE DEMANDER";
		$entete[4] = "OBSERVATIONS";
		$pdf->SetTextColor(0,0,0);
		//En-tête tableau
		$pdf->SetFont('helvetica','B',7);
		$w=array(10,90,30,30,30);
		$pdf->SetFillColor(0,148,255);
		for($i=0;$i<count($entete);$i++){
			$pdf->Cell($w[$i],10,($entete[$i]),1,0,'C',0);
		}
		$pdf->Ln(10);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('helvetica','',7);
		if(count($contenue) !=0){
            $i = 1;
			foreach($contenue as $contenue) {
				$pdf->Cell($w[0],8,$i,1,0,'C');
				$pdf->Cell($w[1],8,$contenue->getCtImprimeTech()->getNomImprimeTech().' ('.$contenue->getCtImprimeTech()->getAbrevImprimeTech().')',1);
				$pdf->Cell($w[2],8,"",1,0,'C');
				$pdf->Cell($w[3],8,$contenue->getEdbQteDemander(),1,0,'C');
				$pdf->Cell($w[4],8,"",1,0,'C');
				$pdf->Ln(8);
                $i++;
			}
		}else{
			$pdf->Cell(190,8,"NEANT",1,0,"C");
			$pdf->Ln(4);
		}

        $pdf->Output('edb_'.date('YmdHis').'.pdf', 'I');

    }
}
