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
$pdf = new PDF('P', 'mm', array(10, 10)); // P untuk Portrait, mm untuk milimeter, array(30, 30) untuk ukuran khusus

// Atur margin (opsional, jika ingin mengurangi margin default)
$pdf->SetMargins(2, 2, 2); // Margin kiri, atas, kanan

// Tambahkan halaman baru
$pdf->AddPage();

// Atur font
$pdf->SetFont('Arial', 'B', 8); // Ukuran font disesuaikan agar sesuai dengan ukuran kertas kecil

// Tambahkan teks

// Hasilkan dokumen
$pdf->Output('I', 'test_print.pdf'); // I untuk menampilkan dalam browser, test_print.pdf sebagai nama file
