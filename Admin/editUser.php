<?php
// Include the database connection
include_once "Model/connection.php";

// Get the email of the user to be edited
$email = $_GET['email'];

// Fetch the user's current details
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/admin.css">
    <title>Journey Snaps|Admin|Edit User</title>
</head>
<body>
<nav>
    <a href="../index.php">
        <img src="../Images/Logo White.png" alt="Logo">
    </a>
    </nav>

    <main>
        <section class="adminPage">
                <form class="edit-form" method="POST" action="Model/updateUser.php">
                    <h2>Edit User Details</h2>
                    <input type="hidden" name="email" value="<?=$user['email']?>">
                    
                    <label for="userName">Name:</label>
                    <input type="text" name="userName" value="<?=$user['userName']?>">

                    <label for="pNumber">Phone:</label>
                    <input type="text" name="pNumber" value="<?=$user['pNumber']?>">

                    <label for="address">Address:</label>
                    <input type="text" name="address" value="<?=$user['address']?>">

                    <label for="nic">NIC:</label>
                    <input type="text" name="nic" value="<?=$user['nic']?>">

                    <div>
                        <button type="submit">Save</button>
                        <button type="button" onclick="location.href='user.php'">Cancel</button>
                    </div>
                </form>
        </section>
    </main>

    <footer>
        <p>&copy; Journey Snaps 2024</p>
    </footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
