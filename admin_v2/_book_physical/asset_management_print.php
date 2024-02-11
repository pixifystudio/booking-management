<?php
ob_start();
require('fpdf.php');
require("library/inc.connection.php");
//require("library/inc.library.php");
require("library/phpqrcode/qrlib.php");



class PDF extends FPDF
{
  // Page header
  function Header()
  {
  }

  // Page footer
  function Footer()
  {
  }
}

$Code        = isset($_GET['id']) ?  $_GET['id'] : '';
$Version    = isset($_GET['v']) ?  $_GET['v'] : '';
// $mySql        = "SELECT * FROM view_purchase WHERE purchase_id='$Code' and purchase_version='$Version'";
// $myQry        = mysqli_query($koneksidb, $mySql)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
// $myData     = mysqli_fetch_array($myQry);
// $purFor     = $myData['purchase_for'];
// if ($purFor == 'BAHAN BAKU') {
//   $mySql2        = "SELECT status_name FROM master_status WHERE status_group='Purchase_Delivery_Address' AND status_code = 'Bahan Baku'";
// } else {
//   $mySql2        = "SELECT status_name FROM master_status WHERE status_group='Purchase_Delivery_Address' AND status_code = 'Head Office'";
// }
// $myQry2        = mysqli_query($koneksidb, $mySql2)  or die("RENTAS ERP ERROR : " . mysqli_error($koneksidb));
// $myData2     = mysqli_fetch_array($myQry2);
$path = "./uploads/qrcode/";
$file = $path . str_replace("/", "-", $Code) . ".png";
QRcode::png($Code, $file, QR_ECLEVEL_H, 5);
// $Note       = $myData['purchase_note'];
// if ($myData['purchase_date'] < '2022-04-01') {
//   $dataPPN = 0.1;
//   $typePPN = 10;
// } else {
//   $typePPN = 11;
//   $dataPPN = 0.11;
// }
//PDF format
$pdf = new PDF('L', 'mm',  array(50, 30));
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);
$pdf->AddPage();

$mySql   = "SELECT v.* FROM view_document v where category_level_1='PHYSICAL' and document_id='$Code' and document_version='$Version' order  by v.updated_date desc ";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("Error query " . mysqli_error($koneksidb));
$nomor  = 0;
$myData = mysqli_fetch_array($myQry);
$Cover = $myData['document_title_id'];
// $pdf->Image('../app-assets/images/logo/difan.png', 10, 10);

$x = $pdf->GetX();
$y = $pdf->GetY();
//baris ke-1

$pdf->SetXY($x - 7, $y - 9);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial', '', 8);
//$pdf->Cell(5,5,'','L',0,'L',0); 
$pdf->Cell(0, 5, $Code, '', 0, 'L', 0);
$pdf->SetXY($x - 50, $y - 27);
$pdf->Cell(0, 5, $Cover, '', 0, 'L', 0);
$pdf->Image($file, 13, 8.5, 20);
$filename = str_replace('/', '-', $Code . '.pdf');
$pdf->SetTitle($filename);
$pdf->Output('I', $filename);

ob_end_flush();
