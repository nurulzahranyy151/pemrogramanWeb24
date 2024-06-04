<?php
include('fpdf/fpdf.php');
require('fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf -> Output();
?>