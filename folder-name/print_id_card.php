<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['regno'])) {
    die("No student specified");
}

$regno = intval($_GET['regno']);

// Use __DIR__ to reliably include files relative to current script location
include(__DIR__ . "/../Include PHP/database_connection.php");

// Fetch student data by REGNO
$stmt = $conn->prepare("SELECT * FROM student WHERE REGNO = ?");
$stmt->bind_param("i", $regno);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    die("Student not found");
}
$student = $result->fetch_assoc();

require(__DIR__ . '/fpdf.php');

class PDF extends FPDF {
    function showImage() {
        // Make sure this path is relative to this script
        $this->Image(__DIR__ . '/frameFOP.jpg', 8, 10, 200);
    }
    function showProfile($image) {
        $this->Image($image, 130, 30, 55);
    }
    function showBarcode($barcodeImageURL) {
        $this->Image($barcodeImageURL, 130, 95, 56, 8);
    }
}

// Prepare data for PDF
$formattedRegNo = "TE" . sprintf("%04d", $student['REGNO']);
$formattedIndexNo = $student['INDEXNO'];
$fullName = $student['FIRSTNAME'] . " " . $student['LASTNAME'];

// Image path outside Student_Registration, so go up one directory
$imagePath = __DIR__ . "/../profile/" . $student['IMAGE'];

// Check if profile image exists, fallback if needed
if (!file_exists($imagePath)) {
    $imagePath = __DIR__ . '/default_profile.png'; // Optional: a default placeholder image inside Student_Registration folder
}

$barcodePath = __DIR__ . "/" . $student['BARCODE'];

$pdf = new PDF('L', 'mm', 'A5');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('courier', 'B', 16);
$pdf->showImage();
$pdf->showProfile($imagePath);
$pdf->cell(39, 30, '');
$pdf->ln();
$pdf->cell(10, 0, '');
$pdf->cell(50, 10, $fullName);
$pdf->ln();
$pdf->cell(10, 10, '');
$pdf->ln();
$pdf->cell(10, 10, '');
$pdf->cell(39, 10, $formattedRegNo);
$pdf->cell(4, 10, '');
$pdf->cell(39, 10, $student['DEPARTMENT']);
$pdf->ln();
$pdf->cell(10, 4, '');
$pdf->ln();
$pdf->cell(10, 10, '');
$pdf->cell(39, 10, $student['PHONENUMBER']);
$pdf->cell(4, 10, '');
$pdf->cell(32, 10, $formattedIndexNo);
if (file_exists($barcodePath)) {
    $pdf->showBarcode($barcodePath);
}
        $pdf->Output('I', 'id_card_' . $regno . '_' . time() . '.pdf');
