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
}

// Buat instance dari kelas FPDF
$pdf = new PDF('P', 'mm', array(50, 100)); // P untuk Portrait, mm untuk milimeter, array(30, 30) untuk ukuran khusus

// Atur margin (opsional, jika ingin mengurangi margin default)
$pdf->SetMargins(2, 2, 2); // Margin kiri, atas, kanan

// Tambahkan halaman baru
$pdf->AddPage();
$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetXY($x, $y);
$pdf->Image('../app-assets/images/logo/pixify.png', 30, 30);
$pdf->SetFont('Arial', 'B', 10); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(45, 6, 'R E C E I P T', '', 0, 'C', 0);
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 4); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil

$pdf->Line(0, 15, 260, 15); // A horizontal line from (10, 20) to (200, 20)
$pdf->Cell(45, 6, 'Perumahan Villa Mutiara Lido 2 Blok A-17', '', 0, 'C', 0);
$pdf->Ln(2);
$pdf->Cell(45, 6, 'Benda, Cicurug, Sukabumi', '', 0, 'C', 0);
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 3.5); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(25, 6, 'Tanggal Cetak:', '', 0, 'L', 0);
$pdf->Cell(25, 6, '23 Mei 2024 14.02', '', 0, 'L', 0);
$pdf->Ln(2);
$pdf->Cell(25, 6, 'Tanggal Foto:', '', 0, 'L', 0);
$pdf->Cell(25, 6, '20 Mei 2024 14.02', '', 0, 'L', 0);
$pdf->Ln(2);



$pdf->Ln(10);
$pdf->SetFont('Arial', '', 7); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(35, 6, 'Photobox', '', 0, 'L', 0);
$pdf->Cell(53, 6, '30.000', '', 0, 'L', 0);
$pdf->Ln(5);
$pdf->Cell(35, 6, 'self photo', '', 0, 'L', 0);
$pdf->Cell(53, 6, '50.000', '', 0, 'L', 0);


$pdf->Ln(20);

$pdf->Cell(45, 6, 'TERIMAKASIH!', '', 0, 'C', 0);





// Atur font

// Tambahkan teks

// Hasilkan dokumen
$pdf->Output('I', 'test_print.pdf'); // I untuk menampilkan dalam browser, test_print.pdf sebagai nama file
