<?php
// Include the database connection file
include 'connection.php';

// Get the form data
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute the SQL query to check the user credentials
$stmt = $conn->prepare("SELECT adminName FROM admin WHERE adminEmail = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Login successful
    $row = $result->fetch_assoc();
    $userName = $row['adminName'];

    // Start the session and store the user's name
    session_start();
    $_SESSION['adminName'] = $userName;

    // Redirect to the index.php page
    header("Location: ../adminPage.php");
    exit;
} else {
    // Login failed
    echo "<script>alert('Invalid email or password.'); window.location.href = '../adminLogin.php';</script>";

}

$stmt->close();
$conn->close();
?>
