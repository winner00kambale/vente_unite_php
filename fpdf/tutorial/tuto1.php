<?php
require('../fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',50);
$pdf->Cell(60,100,'Joel Bonjour!');
$pdf->Output();
?>
