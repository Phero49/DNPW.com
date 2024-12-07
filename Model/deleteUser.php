<?php
    include_once "connection.php";

    $email = $_GET['email'];

    $stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        session_start();
        session_destroy();
        header("Location: ../userProfile.php?message=deleted");
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
?>