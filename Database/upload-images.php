<?php
// Include database connection
require_once './dbConfig.php'; // Assuming the connection function is in this file

// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Check if an image file was uploaded
if (!isset($_FILES['image'])) {
    echo json_encode(['success' => false, 'message' => 'No image file uploaded']);
    exit;
}

// Check if title and caption are provided
if (!isset($_POST['title']) || !isset($_POST['caption'])) {
    echo json_encode(['success' => false, 'message' => 'Title and caption are required']);
    exit;
}

// Get the uploaded file and form data
$image = $_FILES['image'];
$title = trim($_POST['title']);
$caption = trim($_POST['caption']);
$userId = isset($_POST['user_id']) ? trim($_POST['user_id']) : null;

// Validate inputs: Title and caption must not be empty
if (empty($title) || empty($caption)) {
    echo json_encode(['success' => false, 'message' => 'Title and caption cannot be empty']);
    exit;
}

// Validate image file type
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($image['type'], $allowedTypes)) {
    echo json_encode(['success' => false, 'message' => 'Invalid image format. Only JPG, PNG, and GIF are allowed.']);
    exit;
}

// Define upload directory
$uploadDir = '../uploads/images/';
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0777, true)) {
        $error = error_get_last();
        echo json_encode(['success' => false, 'message' => 'Failed to create upload directory'.$error['message']]);
        exit;
    }  
}

// Generate a unique filename to avoid overwriting
$fileName = uniqid('img_', true) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
$filePath = $uploadDir . $fileName;

// Move the uploaded file to the server directory
if (!move_uploaded_file($image['tmp_name'], $filePath)) {
    echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
    exit;
}

// Prepare to insert data into the database
$pdo = connectToDatabase();

try {
    // Insert image data into the database
    $stmt = $pdo->prepare("INSERT INTO images (path, title, caption, user) VALUES (:path, :title, :caption, :user)");
    $stmt->bindParam(':path', $filePath);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':caption', $caption);
    $stmt->bindParam(':user', $userId);
    $stmt->execute();

    // Send success response
    header('Content-Type: application/json');

    echo json_encode(['success' => true, 'message' => 'Image uploaded successfully']);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

