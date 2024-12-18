<?php
require_once "./dbConfig.php";
$pdo = connectToDatabase();
session_start();
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    echo 'forbidden';
    exit;
}

// Check if content and id are provided in the POST request
if (isset($_POST['content']) && isset($_POST['id'])) {
    $content = $_POST['content'];
    $id = $_POST['id'];
    $published = $_POST['published'];

    // Prepare the SQL query to update the content
    if (isset($published)) {

        $sql = "UPDATE `news` SET `content` = ?, `user_id` = ?, `published`=1, `published_date`=NOW() WHERE `id` = ?";

    }else{
            $sql = "UPDATE `news` SET `content` = ?, `user_id` = ? WHERE `id` = ?";

    }
    
    try {
        // Use a prepared statement to update the data securely
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$content, $userId, $id]);

        echo 'Content updated successfully!';
    } catch (PDOException $e) {
        // Handle database errors
        echo 'Error updating content: ' . $e->getMessage();
    }
} else {
    echo 'Content or ID not provided';
    exit;
}
?>
