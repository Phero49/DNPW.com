<?php
session_start();
require('fpdf/fpdf.php');

// Check if the cart session exists and has items
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: ../gallery.php');
    exit();
}

// Define the path for saving the PDF invoice
$pdf_output_dir = '../Invoices';
$pdf_filename = 'invoice_' . time() . '.pdf';
$pdf_output = $pdf_output_dir . '/' . $pdf_filename;

// Check if the Invoices directory exists; if not, create it
if (!is_dir($pdf_output_dir)) {
    mkdir($pdf_output_dir, 0777, true);
}

// Initialize the PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$logo_path = '../Images/Logo WhiteINVO.png';
if (file_exists($logo_path)) {
    $pageWidth = $pdf->GetPageWidth();
    $logoWidth = 70; 
    $x = ($pageWidth - $logoWidth) / 2;
    
    // Add the centered logo (x position calculated, y at 10mm from top)
    $pdf->Image($logo_path, $x, 10, $logoWidth);
    
    // Add space after logo
    $pdf->Ln(30); // Increased space to accommodate logo
}

// Add Current Date and Time
$pdf->SetFont('Arial', '', 12);
$currentDateTime = date('Y-m-d H:i:s');
$pdf->Cell(0, 10, 'Date: ' . $currentDateTime, 0, 1, 'R');

// Add Invoice Number
$pdf->Cell(0, 10, 'Invoice No: INV-' . time(), 0, 1, 'R');

// Add Customer Details
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Customer Details:', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Name: ' . (isset($_SESSION['userName']) ? $_SESSION['userName'] : 'Guest'), 0, 1, 'L');

$pdf->Ln(10);

// Define the table width and calculate the starting X position to center it
$tableWidth = 170; // Total width of the table (80 + 30 + 30 + 30)
$x = ($pdf->GetPageWidth() - $tableWidth) / 2; // Calculate starting X position

// Add table headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0, 0, 0); // Black background
$pdf->SetTextColor(255, 255, 255); // White text

// Center-align table headers
$pdf->SetX($x);
$pdf->Cell(80, 10, 'Item', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Quantity', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Price', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Total', 1, 1, 'C', true);

// Reset text color back to black for the table content
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 12);

// Initialize total amount
$totalAmount = 0;

// Display cart items with alternating row colors and center alignment
$fill = false;
foreach ($_SESSION['cart'] as $item) {
    $item_name = $item['name'];
    $item_quantity = $item['quantity'];
    $item_price = $item['price'];
    $item_total = $item_quantity * $item_price;
    $totalAmount += $item_total;

    // Set alternating row background color
    $pdf->SetFillColor(245, 245, 245); // Light gray for alternating rows

    // Center-align each row of the table
    $pdf->SetX($x);
    $pdf->Cell(80, 10, $item_name, 1, 0, 'C', $fill);
    $pdf->Cell(30, 10, $item_quantity, 1, 0, 'C', $fill);
    $pdf->Cell(30, 10, 'Rs. ' . number_format($item_price, 2), 1, 0, 'C', $fill);
    $pdf->Cell(30, 10, 'Rs. ' . number_format($item_total, 2), 1, 1, 'C', $fill);
    $fill = !$fill; // Toggle fill for next row
}

// Add Total Amount row with styling and center alignment
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX($x);
$pdf->Cell(140, 10, 'Total Amount', 1, 0, 'L', true);
$pdf->Cell(30, 10, 'Rs. ' . number_format($totalAmount, 2), 1, 1, 'C', true);
$pdf->Ln(20);

// Footer message
$pdf->SetFont('Arial', 'I', 10);
$pdf->SetTextColor(0, 0, 0); // Reset text color
$pdf->Cell(0, 10, 'Thank you for shopping with Journey Snaps!', 0, 1, 'C');
$pdf->Cell(0, 10, 'For any queries, please contact us at info@journeysnaps.com', 0, 1, 'C');

// Output the PDF to the file
try {
    $pdf->Output('F', $pdf_output);

    // Clear cart session after generating the invoice
    $_SESSION['cart'] = [];

    // Redirect to the PDF file
    header('Location: ' . $pdf_output);
    exit();
} catch (Exception $e) {
    echo "Error generating PDF: " . $e->getMessage();
}
?>
