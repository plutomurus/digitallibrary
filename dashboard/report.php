<?php 
// Muat DOMPDF
require_once '../dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// File PHP yang ingin Anda jalankan
$phpFile = 'report2.php';

// Memuat dan mengeksekusi file PHP
ob_start();
require $phpFile;
$html = ob_get_clean();

// Load HTML ke DOMPDF
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$date = date('Ymdhis');
$dompdf->stream($date);
?>
