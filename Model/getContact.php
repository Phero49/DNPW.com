<?php
    include 'connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            $stmt = $conn->prepare("INSERT INTO msg (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);

            if ($stmt->execute()) {
                echo "<script>
                    window.location.href = '../contact.php';
                </script>";
            } else {
                echo "<script>
                    alert('Message sending failed. Please try again.');
                    window.location.href = '../contact.php';
                </script>";
            }

            $stmt->close();
            $conn->close();

        } catch(Exception $e) {
            echo "<script>
                alert('An error occurred. Please try again.');
                window.location.href = '../contact.php';
            </script>";
        }
    }
?>