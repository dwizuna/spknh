<?php
//============================================================+
// File name   : example_027.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 027 for TCPDF class
//               1D Barcodes
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: 1D Barcodes.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ipang.dwi');
$pdf->SetTitle('om.ip.concerto');
$pdf->SetSubject('ticket from om.ip.concerto');
$pdf->SetKeywords('ticket, om ip, concerto');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'om.ip.concerto', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set a barcode on the page footer
$pdf->setBarcode(date('Y-m-d H:i:s'));

// set font
$pdf->SetFont('helvetica', '', 11);

// add a page
$pdf->AddPage();

// print a message
$txt = "Just print and shown it as your ticket.\n Ticket generate by om.ip.concerto";
$pdf->MultiCell(70, 50, $txt, 0, 'R', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
$pdf->SetY(30);

// -----------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 10);

// define barcode style
$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => true,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);

// EAN 13
$pdf->Cell(0, 0, 'Your Ticket ID', 0, 1);
$pdf->write1DBarcode('249128786', 'EAN13', '', '', '', 18, 0.4, $style, 'N');

$pdf->Ln();
// ---------------------------------------------------------
// Set some content to print
$html = <<<EOD
<h1>Virtual Ticket for <a href="http://www.firstplato.com" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:white;">SURABAYA JAZZ FEST</span>&nbsp;</a></h1>
<p>Original SURABAYA JAZZ FEST ticket by MONSTER-KONSER, special for :</p>
<table>
<tr><td width="20%">Nama</td><td width="70%">Gonzales Corbeti (g.corbeti@gmail.com) - ID.card 3151528071986005</td></tr>
<tr><td>Class</td><td>VIP</td></tr>
<tr><td>TKP</td><td>Gedung Serbaguna - GOR Sidoarjo</td></tr>
<tr><td>Jam</td><td>19.00 - Selesai</td></tr>
<tr><td>Dresscode</td><td>Free</td></tr>
</table>
<p align="center" style="color:#CC0000;">NB : Satu tiket berlaku untuk satu orang. Tunjukkan juga ID Card bila diperlukan.</p>
<hr>
<p align="center"><i>Monster-Konser, tempat simple untuk beli tiket konser online dan tanpa ribet.</i></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('aero.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
