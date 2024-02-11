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
  var $widths;
  var $aligns;

  function SetWidths($w)
  {
    $this->widths = $w;
  }

  function SetAligns($a)
  {
    $this->aligns = $a;
  }
  function Row($data)
  {
    $nb = 0;
    for ($i = 0; $i < count($data); $i++)
      $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
    $h = 4 * $nb;
    $this->CheckPageBreak($h);
    for ($i = 0; $i < count($data); $i++) {
      $w = $this->widths[$i];
      $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
      $x = $this->GetX();
      $y = $this->GetY();
      $this->Rect($x, $y, $w, $h);
      $this->MultiCell($w, 4, $data[$i], 0, $a);
      $this->SetXY($x + $w, $y);
    }
    $this->Ln($h);
  }
  function CheckPageBreak($h)
  {
    if ($this->GetY() + $h > $this->PageBreakTrigger)
      $this->AddPage($this->CurOrientation);
  }

  function NbLines($w, $txt)
  {
    $cw = &$this->CurrentFont['cw'];
    if ($w == 0)
      $w = $this->w - $this->rMargin - $this->x;
    $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
    $s = str_replace("\r", '', $txt);
    $nb = strlen($s);
    if ($nb > 0 and $s[$nb - 1] == "\n")
      $nb--;
    $sep = -1;
    $i = 0;
    $j = 0;
    $l = 0;
    $nl = 1;
    while ($i < $nb) {
      $c = $s[$i];
      if ($c == "\n") {
        $i++;
        $sep = -1;
        $j = $i;
        $l = 0;
        $nl++;
        continue;
      }
      if ($c == ' ')
        $sep = $i;
      $l += $cw[$c];
      if ($l > $wmax) {
        if ($sep == -1) {
          if ($i == $j)
            $i++;
        } else
          $i = $sep + 1;
        $sep = -1;
        $j = $i;
        $l = 0;
        $nl++;
      } else
        $i++;
    }
    return $nl;
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
// $path = "./uploads/qrcode/purchase/";
// $file = $path . str_replace("/", "-", $myData['purchase_id']) . ".png";
// QRcode::png($link . '/?page=PDF-FOP-Purchase-Order&id=' . $myData['purchase_id'] . '&v=' . $Version . '', $file, QR_ECLEVEL_H, 5);
// $Note       = $myData['purchase_note'];
// if ($myData['purchase_date'] < '2022-04-01') {
//   $dataPPN = 0.1;
//   $typePPN = 10;
// } else {
//   $typePPN = 11;
//   $dataPPN = 0.11;
// }
//PDF format
$pdf = new PDF('L', 'mm',  array(300, 500));
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);
$pdf->AddPage();
// $pdf->Image('../app-assets/images/logo/difan.png', 10, 10);

//baris ke-1
$pdf->SetY(31);
$pdf->SetFont('Arial', 'B', 14);
// $pdf->Cell(190, 7, 'PURCHASE ORDER ( PO )', '1', '0', 'C', 0);
$pdf->Ln();
$pdf->Image($file, 160, 75, 20);

//baris ke-2
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x + 36, $y - 15);
$pdf->MultiCell(153, 5, '');
$pdf->SetXY($x, $y);
$pdf->Cell(100, 5, '', '', 0, 'L', 0);
$pdf->Cell(90, 5, date('Y-m-d H:i:s'), '', 0, 'R', 0);
$pdf->Ln();
//$pdf->SetFont('Arial', '',8);  
//$pdf->Cell(5,5,'','L',0,'L',0); 
//$pdf->Cell(185,5,'NOTE :','R',0,'L',0); 
//$pdf->Ln();
//$pdf->SetFont('Arial', '',8);  
//$pdf->Cell(5,5,'','LB',0,'L',0); 
//$pdf->Cell(185,5,'','RB',0,'L',0);
//$pdf->Ln();
$filename = str_replace('/', '-', 'PO-.pdf');
// $pdf->SetTitle($filename);
$pdf->Output('I', $filename);

ob_end_flush();
