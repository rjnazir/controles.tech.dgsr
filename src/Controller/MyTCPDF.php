<?
    require_once('tcpdf/tcpdf.php');

    class MyTCPDF extends TCPDF {
        public function Header() {
            $this->setPrintHeader(false);
            // Code pour personnaliser le contenu du header
            // Exemple : $this->Cell(0, 10, 'Mon Header', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    
        public function Footer() {
            $this->setPrintFooter(true);
            $this->SetFooterFont(Array('times', '', 10));
            $this->SetFooterMargin(10);
            $this->SetFooterData(array(0,0,0), array(0,0,0));
            $this->MultiCell(0, 5, 'Editée le ' . date('d/m/Y') .' à ' . date('H:i:s') . ' par ' . $this->getUser()->getUsrnamecomplet() , 0, 0, 'L');
            // Code pour personnaliser le contenu du footer
            // Exemple : $this->Cell(0, 10, 'Mon Footer', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }
?>