<?php
require('fpdf.php');

// Validasi terlebih dahulu
$id = isset($_GET['id']) ? $_GET['id'] : null;
$s = isset($_GET['s']) ? $_GET['s'] : '';

if (!empty($s)) {
  // Alihkan ke halaman lain sebelum memulai output PDF
  header("Location: https://pixify.id/admin/?page=Management-Booking-Process");
  exit(); // Pastikan untuk menghentikan eksekusi skrip setelah pengalihan
}

// Lanjutkan jika $s kosong (atau jika validasi telah lewat)
class PDF extends FPDF
{
  // Header
  function Header()
  {
    // Nothing needed here for this simple example
  }

  // Footer
  function Footer()
  {
    $this->SetY(-11);
    $this->SetFont('Arial', 'B', 7);
    $this->Cell(5, 6, '', '', 0, 'L', 0);
    $this->Cell(45, 6, '0851-7121-2096      @PXY.STUDIO', '', 0, 'L', 0);
  }

  function DashedLine($x1, $y1, $x2, $y2, $dash_length = 1, $space_length = 1)
  {
    $this->SetLineWidth(0.2);
    $length = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
    $dash_count = $length / ($dash_length + $space_length);
    $x_step = ($x2 - $x1) / $dash_count;
    $y_step = ($y2 - $y1) / $dash_count;

    for ($i = 0; $i < $dash_count; $i++) {
      $x_start = $x1 + $i * ($x_step + $space_length);
      $y_start = $y1 + $i * ($y_step + $space_length);
      $x_end = $x_start + $x_step;
      $y_end = $y_start + $y_step;
      $this->Line($x_start, $y_start, $x_end, $y_end);
    }
  }
}

// Buat instance dari kelas FPDF
$pdf = new PDF('P', 'mm', array(50, 130));

// Atur margin
$pdf->SetMargins(2, 2, 2);

// Tambahkan halaman baru
$pdf->AddPage();
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Image('../app-assets/images/logo/pixifylogoonly.png', 12, 0, 25);
$pdf->Image('../app-assets/images/logo/strukpixify.jpg', 15, 98, 20);
$pdf->Image('../app-assets/images/logo/instagram.png', 27.5, 120.3, 3);
$pdf->Image('../app-assets/images/logo/whatsapp.png', 4.5, 120.3, 3);
$pdf->SetXY($x, $y + 20);

$mySql   = "SELECT * FROM booking where id='$id'  order by updated_date asc";
$myQry   = mysqli_query($koneksidb, $mySql)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
$myData = mysqli_fetch_array($myQry);

$dp = isset($myData['dp']) ? $myData['dp'] : 0;
$tanggal = isset($myData['tanggal']) ? $myData['tanggal'] : 0;
$jam = isset($myData['jam']) ? $myData['jam'] : 0;
$tanggal_foto = $tanggal . ' ' . $jam;

$tanggal_cetak = date('d F Y G:i');
$tanggal_foto = date("d F Y G:i", strtotime($tanggal_foto));

// Isi PDF
$pdf->SetFont('Arial', 'B', 19);
$pdf->Cell(45, 6, ' RECEIPT', '', 0, 'C', 0);
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 7);

$pdf->Line(0, 35, 260, 35);
$pdf->Cell(45, 6, 'Perumahan Villa Mutiara Lido 2 Blok A-17', '', 0, 'C', 0);
$pdf->Ln(3);
$pdf->Cell(45, 6, 'Benda, Cicurug, Sukabumi', '', 0, 'C', 0);
$pdf->Ln(4.5);

$pdf->SetFont('Arial', '', 6.5);
$pdf->Cell(24, 6, 'Tanggal Cetak:', '', 0, 'L', 0);
$pdf->Cell(25, 6, $tanggal_cetak, '', 0, 'L', 0);
$pdf->Ln(3);
$pdf->Cell(24, 6, 'Tanggal Foto:', '', 0, 'L', 0);
$pdf->Cell(25, 6, $tanggal_foto, '', 0, 'L', 0);
$pdf->Ln(3);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x - 60, $y);
$pdf->Cell(198, 6, '-------------------------------------------------------------------------------------------------------------------------------------------------------', '', 0, 'L', 0);

$pdf->Ln(3);

// INSERT LIST ITEM
$mySql1   = "SELECT * FROM booking_detail where booking_id='$id' group by booking_detail_id  order by updated_date asc";
$myQry1   = mysqli_query($koneksidb, $mySql1)  or die("ERROR BOOKING:  " . mysqli_error($koneksidb));
$nomor  = 0;
$total = 0;
while ($myData1 = mysqli_fetch_array($myQry1)) {
  $pdf->SetFont('Arial', 'B', 6.5);
  $pdf->Cell(1, 6, '', '', 0, 'L', 0);
  $pdf->Cell(35, 6, $myData1['item'], '', 0, 'L', 0);
  $pdf->Ln(2);
  $pdf->SetFont('Arial', '', 6.5);
  $pdf->Cell(3, 6, '', '', 0, 'L', 0);
  $pdf->Cell(30, 6, $myData1['qty'] . ' x ' . number_format($myData1['nominal']), '', 0, 'L', 0);
  $pdf->Cell(25, 6, 'Rp' . number_format(($myData1['qty'] * $myData1['nominal'])), '', 0, 'L', 0);

  $total = $total + ($myData1['qty'] * $myData1['nominal']);
  $pdf->Ln(3);
}

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x - 60, $y);
$pdf->Cell(198, 6, '-------------------------------------------------------------------------------------------------------------------------------------------------------', '', 0, 'L', 0);

$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(11, 6, '', '', 0, 'L', 0);
$pdf->Cell(22, 6, 'Total: ', '', 0, 'L', 0);
$pdf->Cell(10, 6, 'Rp' . number_format($total, 0), '', 0, 'L', 0);
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(11, 6, '', '', 0, 'L', 0);
$pdf->Cell(22, 6, 'DP: ', '', 0, 'L', 0);
$pdf->Cell(10, 6, 'Rp' . number_format($dp, 0), '', 0, 'L', 0);
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(11, 6, '', '', 0, 'L', 0);
$pdf->Cell(22, 6, 'Sisa Pembayaran: ', '', 0, 'L', 0);
$pdf->Cell(10, 6, 'Rp' . number_format(($total - $dp)), '', 0, 'L', 0);
$pdf->Ln(2);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x, $y + 3);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(45, 6, 'Terimakasih sudah foto di Pixify Studio', '', 0, 'C', 0);
$pdf->Ln(2);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x, $y);
$pdf->Cell(45, 6, 'Jangan lupa rating kita ya! :D', '', 0, 'C', 0);
$pdf->Ln(2);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x, $y + 22.4);

$pdf->Output('I', 'test_print.pdf');
