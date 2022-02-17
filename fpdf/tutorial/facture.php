<?php
require('../fpdf.php');
class PDF extends FPDF
{
// Load data
function LoadData($file)
{
	// Read file lines
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
	$data[] = explode(';',trim($line));
	return $data;
}

// Simple table
function BasicTable()
{
	// Header
	$this->Image('entete2.jpg',6,5,196);
	$this->Ln(35);
	require '../../connexion.php';
	$req=$con->query('SELECT * FROM `panier`');
    $req = $req->fetch();
    $req1=$con->query('SELECT * FROM `panier`');
    $req2=$con->query('SELECT SUM(montant)AS tot FROM `panier`');
    $req2 = $req2->fetch();
	$this->Cell(175,12,'Facture de :      '.$req['client'],1,0,'C');
		$this->Ln();
		$this->Cell(25,6,'numero',1,0,'C');
		$this->Cell(50,6,'Article',1,0,'C');
		$this->Cell(50,6,'Nombre',1,0,'C');
		$this->Cell(50,6,'montant',1,0,'C');
		$this->Ln();

	while ($row = $req1->fetch(PDO::FETCH_OBJ)) {
		
		$this->Cell(25,8,$row->id,1,0,'C');
		$this->Cell(50,8,$row->article,1,0,'C');
		$this->Cell(50,8,$row->nombre,1,0,'C');
		$this->Cell(50,8,$row->montant,1,0,'C');
		$this->Ln();
	}
    $this->Cell(175,6,'                       Montant Total à payer :                  |     '  .$req2['tot']. '    USD',1,0,'C');
    $this->Ln();
    $this->Cell(37,12,'Day : '.$req['date'],0,0,'C');

    $req=$con->query('DELETE FROM `panier`');
    $req->execute();
	// Data
	// foreach($data as $row)
	// {
	// 	foreach($row as $col)
			
	// 		$this->Cell(40,6,$col,1);
	// 	$this->Ln();
	// }
}

// Better table
function ImprovedTable($data)
{
	// Column widths
	$w = array(40, 35, 40, 45);
	
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR');
		$this->Cell($w[1],6,$row[1],'LR');
		$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
		$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
		$this->Ln();
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($data)
{
	// Colors, line width and bold font
	$this->SetFillColor(255,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');
	// Header
	$w = array(40, 35, 40, 45);
	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	// Data
	$fill = false;
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		$this->Ln();
		$fill = !$fill;
	}
	// Closing line
	$this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->BasicTable();
// $pdf->AddPage();
// $pdf->ImprovedTable($data);
// $pdf->AddPage();
// $pdf->FancyTable($data);
$pdf->Output();
