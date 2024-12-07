<?php
    include_once "connection.php";

    $email = $_GET['email'];

    $stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        header("Location: ../user.php?message=deleted");
        exit;
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
?>
