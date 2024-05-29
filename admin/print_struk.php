<?php
require('fpdf.php'); // Ganti 'path/to/fpdf.php' dengan path yang sesuai ke file fpdf.php di proyek Anda

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
    // Nothing needed here for this simple example
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
$pdf = new PDF('P', 'mm', array(50, 100)); // P untuk Portrait, mm untuk milimeter, array(30, 30) untuk ukuran khusus

// Atur margin (opsional, jika ingin mengurangi margin default)
$pdf->SetMargins(2, 2, 2); // Margin kiri, atas, kanan

// Tambahkan halaman baru
$pdf->AddPage();
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Image('../app-assets/images/logo/pixifystudio.png', 17, 0, 15);
$pdf->SetXY($x, $y);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(45, 6, 'R E C E I P T', '', 0, 'C', 0);
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 4); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil

$pdf->Line(0, 30, 260, 30); // A horizontal line from (10, 20) to (200, 20)
$pdf->Cell(45, 6, 'Perumahan Villa Mutiara Lido 2 Blok A-17', '', 0, 'C', 0);
$pdf->Ln(2);
$pdf->Cell(45, 6, 'Benda, Cicurug, Sukabumi', '', 0, 'C', 0);
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 3.5); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(2, 6, '', '', 0, 'L', 0);
$pdf->Cell(28, 6, 'Tanggal Cetak:', '', 0, 'L', 0);
$pdf->Cell(25, 6, '23 Mei 2024 14.02', '', 0, 'L', 0);
$pdf->Ln(2);
$pdf->Cell(2, 6, '', '', 0, 'L', 0);
$pdf->Cell(28, 6, 'Tanggal Foto:', '', 0, 'L', 0);
$pdf->Cell(25, 6, '20 Mei 2024 14.02', '', 0, 'L', 0);
$pdf->Ln(2);


$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x - 60, $y);
$pdf->Cell(198, 6, '-------------------------------------------------------------------------------------------------------------------------------------------------------', '', 0, 'L', 0);



$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x, $y);



$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 3.5); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(4, 6, '', '', 0, 'L', 0);
$pdf->Cell(35, 6, 'Self Photo', '', 0, 'L', 0);
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 3.5); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(4, 6, '', '', 0, 'L', 0);
$pdf->Cell(30, 6, '2 x Rp 50.000', '', 0, 'L', 0);
$pdf->Cell(25, 6, 'Rp 100.000', '', 0, 'L', 0);

$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 3.5); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(4, 6, '', '', 0, 'L', 0);
$pdf->Cell(35, 6, 'Self Photo', '', 0, 'L', 0);
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 3.5); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(4, 6, '', '', 0, 'L', 0);
$pdf->Cell(30, 6, '2 x Rp 50.000', '', 0, 'L', 0);
$pdf->Cell(25, 6, 'Rp 100.000', '', 0, 'L', 0);


$pdf->Ln(5);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x - 60, $y);
$pdf->Cell(198, 6, '-------------------------------------------------------------------------------------------------------------------------------------------------------', '', 0, 'L', 0);

$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 3.5); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(20, 6, '', '', 0, 'L', 0);
$pdf->Cell(14, 6, 'Total: ', '', 0, 'L', 0);
$pdf->Cell(10, 6, 'Rp 200.000 ', '', 0, 'L', 0);

$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 3.5); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(20, 6, '', '', 0, 'L', 0);
$pdf->Cell(14, 6, 'DP: ', '', 0, 'L', 0);
$pdf->Cell(10, 6, 'Rp 20.000 ', '', 0, 'L', 0);

$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 3.5); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(20, 6, '', '', 0, 'L', 0);
$pdf->Cell(14, 6, 'Sisa Pembayaran: ', '', 0, 'L', 0);
$pdf->Cell(10, 6, 'Rp 180.000 ', '', 0, 'L', 0);

$pdf->Ln(4);

$pdf->SetFont('Arial', '', 3); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(45, 6, 'Terimakasih sudah foto di Pixify Studio', '', 0, 'C', 0);
$pdf->Ln(1.5);
$pdf->Cell(45, 6, 'Kamu bisa share pengalaman foto kamu dengan cara scan QR berikut', '', 0, 'C', 0);
$pdf->Ln(1.5);
$pdf->Cell(45, 6, 'atau upload keseruannya di socmed dan tag akun kita ya!', '', 0, 'C', 0);






// Atur font

// Tambahkan teks

// Hasilkan dokumen
$pdf->Output('I', 'test_print.pdf'); // I untuk menampilkan dalam browser, test_print.pdf sebagai nama file
