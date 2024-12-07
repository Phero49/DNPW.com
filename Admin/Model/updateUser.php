<?php
// Include the database connection
include_once "connection.php";

// Get the form data
$email = $_POST['email'];
$userName = $_POST['userName'];
$pNumber = $_POST['pNumber'];
$address = $_POST['address'];
$nic = $_POST['nic'];

// Prepare the SQL statement to update the user details
$stmt = $conn->prepare("UPDATE users SET userName = ?, pNumber = ?, address = ?, nic = ? WHERE email = ?");
$stmt->bind_param("sssss", $userName, $pNumber, $address, $nic, $email);

if ($stmt->execute()) {
    // If successful, redirect to the admin page with a success message
    header("Location: ../user.php?message=updated");
    exit;
} else {
    // If there's an error, display an error message
    echo "Error updating user: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
