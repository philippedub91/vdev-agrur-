<?php
require('../fpdf/fpdf.php');

$pdf = new FPDF('P', 'mm', array(270, 180));
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$proprietesTableau = array(
	'TB_ALIGN' => 'L',
	'L_MARGIN' => '15',
	'BRD_COLOR' => array(0, 92, 177),
	'BRD_SIZE' => '0.3',
	);

$propieteHeader = array(
	'T_COLOR' => array(150,10,10),
	'T_SIZE' => 12,
	'T_FONT' => 'Arial',
	'T_ALIGN' => 'C',
	'V_ALIGN' => 'T',
	'T_TYPE' => 'B',
	'LN_SIZE' => 7,
	'BG_COLOR_COL0' => array(170, 240, 230),
	'BG_COLOR' => array(170, 240, 230),
	'BRD_COLOR' => array(0,92,177),
	'BRD_SIZE' => 0.2,
	'BRD_TYPE' => '1',
	'BRD_TYPE_NEW_PAGE' => '',
	);

$contenuHeader = array(
	50, 50, 50,
	"Titre de la première colonne", "année N-1", "année N",
	);

$proprieteContenu = array(
	'T_COLOR' => array(0,0,0),
	'T_SIZE' => 10,
	'T_FONT' => 'Arial',
	'T_ALIGN_COL0' => 'L',
	'T_ALIGN' => 'R',
	'V_ALIGN' => 'M',
	'T_TYPE' => '',
	'LN_SIZE' => 6,
	'BG_COLOR_COL0' => array(245, 245, 150),
	'BG_COLOR' => array(255,255,255),
	'BRD_COLOR' => array(0,92,177),
	'BRD_SIZE' => 0.1,
	'BRD_TYPE' => '1',
	'BRD_TYPE_NEW_PAGE' => '',
	);

$contenuTableau = array(
	"champ 1", 1, 2,
	"champ 2", 3, 4,
	"champ 3", 5, 6,
	"champ 4", 7, 8,
	);


$pdf->drawTableau($pdf, $propritesTableau, $proprieteHeader, $contenuHeader, $proprieteContenu, $contenuTableau);	



$pdf->Output();
?>