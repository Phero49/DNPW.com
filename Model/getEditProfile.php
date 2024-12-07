<?php
    session_start();
    include 'connection.php';

    if (!isset($_SESSION['userName'])) {
        header("Location: ../login.php");
        exit();
    }

    $userName = $_SESSION['userName'];
    $email = $_POST['email'];
    $pNumber = $_POST['pNumber'];
    $address = $_POST['address'];
    $nic = $_POST['nic'];
    $password = $_POST['password'];

    $uploadDir = "../Images/Profile/"; 
    $dbPath = "Images/Profile/";      
    $fileUploadSuccess = false;

    if (!empty($_FILES['profile_pic']['name'])) {
        $fileName = basename($_FILES['profile_pic']['name']);
        $uploadFilePath = $uploadDir . $fileName;  
        $dbFilePath = $dbPath . $fileName;    
        $imageFileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));

        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFilePath)) {
                $fileUploadSuccess = true;
            } else {
                echo "Error uploading profile picture.";
                exit();
            }
        } else {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }
    }

    if ($fileUploadSuccess) {
        $updateQuery = "UPDATE users SET email = ?, pNumber = ?, address = ?, nic = ?, password = ?, DPpath = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("sssssss", $email, $pNumber, $address, $nic, $password, $dbFilePath, $email);
    } else {
        $updateQuery = "UPDATE users SET email = ?, pNumber = ?, address = ?, nic = ?, password = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ssssss", $email, $pNumber, $address, $nic, $password, $email);
    }

    if ($updateStmt->execute()) {
        header("Location: ../userProfile.php");
        exit();
    } else {
        echo "Error updating profile. Please try again.";
    }

    $updateStmt->close();
    $conn->close();
?>
