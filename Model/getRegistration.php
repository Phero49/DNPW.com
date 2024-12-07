<?php

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = htmlspecialchars($_POST['userName']);
    $email = htmlspecialchars($_POST['email']);
    $pNumber = htmlspecialchars($_POST['pno']);
    $address = htmlspecialchars($_POST['address']);
    $nic = htmlspecialchars($_POST['nicno']);
    $password = htmlspecialchars($_POST['pws']);

    // // Hash the password before storing it in the database
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (userName, email, pNumber, address, nic, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $userName, $email, $pNumber, $address, $nic, $password);

    if ($stmt->execute()) {
        echo "<script>window.location.href = '../login.php';</script>";
    } else {
        echo "<script>alert('Registration failed. Please try again.'); window.location.href = '../register.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>