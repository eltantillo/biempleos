<?php
/**
 * @abstract This Component Class is created to access TCPDF plugin for generating reports.
 * @example You can refer http://www.tcpdf.org/examples/example_011.phps for more details for this example.
 * @todo you can extend tcpdf class method according to your need here. You can refer http://www.tcpdf.org/examples.php section for 
 *       More working examples.
 * @version 1.0.0
 */
Yii::import('ext.tcpdf.*');
class MYPDF extends TCPDF {
    
    //Page header
    public function Header() {
        // Logo
        //$image_file = K_PATH_IMAGES . '/logo.png';
        //$this->Image($image_file, 7, 7, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('times', 'B', 30);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(255, 102, 0);
        $this->Cell(5, 0, '', 0, 0, '', 0, '', 0, true);
        $this->SetCellPaddings(10, 3, 0, 0);
        // Title
        $this->Cell(195, 26, 'Solicitud de Empleo', 0, 0, 'L', true, '', 0, true, 'T', 'T');//146
    }
    
    //Page footer
    public function Footer() {
        // Position at 7 mm from bottom
        $this->SetY(-7);
        
        $image_file = K_PATH_IMAGES . '/logo.png';
        $this->Image($image_file, 85.75, $this->GetY(), 5, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('times', '', 10);
        $this->Cell(2.5);
        $this->Cell(10, 0, 'www.biempleos.com', 0, 0, '', false, 'http://www.biempleos.com/');
    }
 
    // Load table data from file
    public function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;
    }
 
    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 35, 40, 45);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}
?>