
<?php
session_start();
ini_set('display_errors', 1);

require_once "../Database/dbConfig.php";
$pdo = connectToDatabase();
// Get the article query from the URL
if (isset($_GET['article'])) {
    $articleId = $_GET['article'];

    // Check if the article exists
    $checkQuery = "SELECT COUNT(*) FROM `news` WHERE `id` = ?";
    $stmt = $pdo->prepare($checkQuery);
    $stmt->execute([$articleId]);
    $articleExists = $stmt->fetchColumn();

    if (!$articleExists) {
        echo 'Article not found';
        exit;
    }
} else {
    // If no article ID is provided, create a new article
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Insert a new article with default values
        $insertQuery = "INSERT INTO `news` (`content`, `user_id`, `cover`, `title`) VALUES ('<h1>Add Article Title </h1>', ?, '', '')";
        try {
            $stmt = $pdo->prepare($insertQuery);
            $stmt->execute([$userId]);

            // Get the ID of the newly created article
            $newArticleId = $pdo->lastInsertId();

            // Redirect to the new article URL
            header("Location: ?article=" . $newArticleId);
            exit;
        } catch (PDOException $e) {
            echo 'Error creating new article: ' . $e->getMessage();
            exit;
        }
    } else {
     header("Location:./adminLogin.php");
        exit;
    }
}

// Proceed with the existing article logic
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <style>

#editor-container {
            width: 80%; /* Adjust as needed */
            max-width: 800px; /* Limit the maximum width */
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin: auto;
        }
        .ql-toolbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: #fff; /* Ensure toolbar stays visible */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional for better visibility */
        }


        .custom-buttons {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .custom-button {
            padding: 8px 12px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .custom-button:hover {
            background-color: #0056b3;
        }

    </style>
</head>

<body style="margin:0px" article="<?php echo     $articleId ?>" > 
<nav style="display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; background-color: #28a745; border-bottom: 1px solid #ddd;">
    <img src="../Images/parks logo.png" style="height: 40px; object-fit: contain;" alt="Logo">
    <div style="display: flex; gap: 10px;">
        <button id="publish-button" style="padding: 8px 12px; border: none; background-color: #007bff; color: white; border-radius: 4px; cursor: pointer; font-size: 14px;">Publish</button>
        <button id="preview-button" style="padding: 8px 12px; border: none; background-color: #007bff; color: white; border-radius: 4px; cursor: pointer; font-size: 14px;">Preview</button>
    </div>
</nav>

<div id="toolbar-container"></div>
    <div id="editor-container"></div>
   

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"> 
    
    </script>
    <script src="../Scripts/editor.js" ></script>
</body>

</html>