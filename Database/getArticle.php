<?php
require_once "../Database/dbConfig.php";
ini_set('display_errors', 1);
$pdo = connectToDatabase();
header('Content-Type: application/json'); // Set the response type to JSON

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];

// Check if an article ID is provided
if (!isset($_GET['article_id'])) {
    echo json_encode(['error' => 'Article ID not provided']);
    exit;
}

$articleId = $_GET['article_id'];

try {
    // Query to fetch the article content
    $query = "SELECT `content`, `title`, `cover` FROM `news` WHERE `id` = ? AND `user_id` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$articleId, $userId]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the article exists
    if (!$article) {
        echo json_encode(['error' => 'Article not found or access denied']);
        exit;
    }

    // Return the article as JSON
    echo json_encode([
        'success' => true,
        'article' => $article,
    ]);
} catch (PDOException $e) {
    // Handle database errors
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    exit;
}
?>