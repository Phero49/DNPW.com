<?php

// Get the image file path from the `img` query parameter
$imagePath = isset($_GET['img']) ? $_GET['img'] : null;

if (!$imagePath) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Image parameter is missing.']);
    exit;
}

// Resolve the absolute path

// Validate the path: Ensure the file exists
if (!file_exists($imagePath)) {
    http_response_code(404); // Not Found
    echo json_encode(['success' => false, 'message' => 'Image not found or access denied.']);
    exit;
}

// Get the MIME type of the image
$mimeType = mime_content_type($imagePath);
if (!$mimeType || strpos($mimeType, 'image/') !== 0) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Invalid image file.']);
    exit;
}

// Serve the image as raw bytes
header('Content-Type: ' . $mimeType);
header('Content-Length: ' . filesize($imagePath));
readfile($imagePath);
exit;
