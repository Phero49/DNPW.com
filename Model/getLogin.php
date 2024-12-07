<?php

include 'connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT userName FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $userName = $row['userName'];

    session_start();
    $_SESSION['userName'] = $userName;

    header("Location: ../index.php");
    exit;
} else {
    echo "<script>alert('Invalid email or password.'); window.location.href = '../login.php';</script>";
}

$stmt->close();
$conn->close();
?>
