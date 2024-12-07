<?php
// Start session
session_start();
ini_set('display_errors', 1);
require "../Database/dbConfig.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/logo2.png">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../Styles/styles.css">

    <script src="Scripts/login.js" defer></script>

</head>

<body>


    <nav>
        <a href="index.php">
            <img src="../Images/parks logo.png" alt="Logo">
        </a>
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="hamburger">&#9776;</label>
        <ul class="menu">

            <li><a href="places.php">Places</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">About Us</a></li>

        </ul>
    </nav>

    <main>
        <section class="adminPage">
            <div class="login-container">
                <h2>Login</h2>
                <?php

$error = false;

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);

                    // Basic validation
                    if (empty($email) || empty($password)) {
                        $error = true;
                    }

                    // Connect to the database
                    $pdo = connectToDatabase();

                    try {
                        // Prepare a query to fetch the user by email
                        $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE email = :email LIMIT 1");
                        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $stmt->execute();

                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                       if ($user != false) {
                          if ($password == $user['password_hash']) {
                            // Login successful: Store user data in session
                            $_SESSION['user_id'] = $user['id'];

                            // Update last_login timestamp
                            $updateStmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = :id");
                            $updateStmt->bindParam(':id', $user['id'], PDO::PARAM_INT);
                            $updateStmt->execute();

                            // echo "Login successful. Welcome!";
                            // Redirect to a protected page
                            header("Location: adminPage.php");
                            exit;
                        } 
                       }
                      else {

                            // Invalid credentials
                            $error = true;

                        }
                    } catch (PDOException $e) {
                        $error = true;
                       

                        die("An error occurred: " . $e->getMessage());
                    }
                }
                ?>

                <?php
            
                echo $error ? "<div  class='error-message' > failed to login check the password or email if this persist contact the admin  </div>
" : ""
                    ?>
                <!-- Login Form -->
                <form action="./adminLogin.php" method="POST">
                    <label for="work email">work email:</label>
                    <input type="email" id="work email" name="email" placeholder="Enter your work email" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>

                    <button type="submit">Login</button>
                </form>

        
            </div>

</body>


</section>
</main>

<footer>
    <p>&copy; Journey Snaps 2024</p>
</footer>
</body>

</html>