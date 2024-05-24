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
$pdf->SetFont('Arial', 'B', 13); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(40, 6, 'STRUK', '', 0, 'C', 0);
$pdf->Ln(5);
$pdf->Image('../app-assets/images/logo/pixify.png',10,10);


$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 7); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil
$pdf->Cell(20, 6, 'Photobox', '', 0, 'L', 0);
$pdf->Cell(53, 6, '30.000', '', 0, 'L', 0);
$pdf->Ln(5);
$pdf->Cell(20, 6, 'self photo', '', 0, 'L', 0);
$pdf->Cell(53, 6, '50.000', '', 0, 'L', 0);


$pdf->Ln(20);

$pdf->Cell(40, 6, 'TERIMAKASIH!', '', 0, 'C', 0);





// Atur font

// Tambahkan teks

// Hasilkan dokumen
$pdf->Output('I', 'test_print.pdf'); // I untuk menampilkan dalam browser, test_print.pdf sebagai nama file
