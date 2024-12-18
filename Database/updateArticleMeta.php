<?php
// Include database configuration
require_once "../Database/dbConfig.php";

// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    echo 'Unauthorized access.';
    exit;
}

// Get user ID from session
$userId = $_SESSION['user_id'];

// Check if title and cover are provided
if (isset($_POST['article_id']) && isset($_POST['title']) && isset($_POST['cover'])) {
    $pdo = connectToDatabase();
    $articleId = $_POST['article_id'];
    $title = $_POST['title'];
    $cover = $_POST['cover'];
    $preview = $_POST['preview'];

    // Sanitize inputs to prevent SQL injection
    $title = htmlspecialchars($title);
    $cover = htmlspecialchars($cover);
    $preview = htmlspecialchars($preview);

    // Prepare SQL query to update title and cover
    $sql = "UPDATE `news` SET `title` = ?, `cover` = ? ,preview = ?  WHERE `id` = ? AND `user_id` = ?";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Execute the query
    if ($stmt->execute([$title, $cover,$preview, $articleId, $userId])) {
        echo 'Article updated successfully.';
    } else {
        echo 'Error updating article.';
    }
} else {
    echo 'Required fields are missing.';
}
?>
