<?php
// Include database configuration
require_once "../Database/dbConfig.php";

// Check if the 'published' status is provided in the GET request
if (isset($_GET['published'])) {
    $pdo = connectToDatabase();
    $published = $_GET['published'];  // e.g., '1' for published, '0' for unpublished

    // Prepare SQL query to retrieve title, cover, and preview
    $sql = "SELECT `id`, `title`, `cover`, `content` FROM `news` WHERE `published` = ?";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Execute the query with the published status
    $stmt->execute([$published]);

    // Fetch all matching articles
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize an array to store the article data
    $result = [];

    foreach ($articles as $article) {
        // Create a preview (first 100 characters of content)
        $preview = substr(strip_tags($article['content']), 0, 100); // Remove HTML tags and get the first 100 characters

        // Add the article info (title, cover, preview) to the result array
        $result[] = [
            'title' => $article['title'],
            'id' => $article['id'],
            'cover' => $article['cover'],
            'preview' => $preview . (strlen($preview) < strlen($article['content']) ? '...' : ''), // Add "..." if preview is truncated
        ];
    }

    // Return the result as a JSON response
    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    echo 'Published status is required.';
}
?>
