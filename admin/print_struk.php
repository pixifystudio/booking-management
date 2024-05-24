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

// Create instance of FPDF class
$pdf = new PDF('P', 'mm', array(10, 30)); // P for Portrait, mm for millimeters, array(58, 30) for custom size

// Add a new page
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', 'B', 12);

// Add text
$pdf->Cell(0, 3, 'Testing', 0, 1, 'C'); // Centered text

// Output the document
$pdf->Output('I', 'test_print.pdf'); // I for inline view in browser, test_print.pdf as the file name
