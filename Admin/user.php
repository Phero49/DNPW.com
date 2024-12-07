<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/Head.png">
    <title>Journey Snaps|Admin|USERs</title>
    <link rel="stylesheet" href="Styles/admin.css">
</head>
<body>

    <nav>
        <a href="../index.php">
            <img src="../Images/Logo White.png" alt="Logo">
        </a>
    </nav>

    <main>
        <section class="adminPage">
            <div >
                <h2>User Details</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">User Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">NIC</th>
                            <th class="text-center">Actions</th> <!-- New Column for Actions -->
                        </tr>
                    </thead>
                    <?php
                        include_once "Model/connection.php";
                        $sql="SELECT * FROM users";
                        $result=$conn-> query($sql);
                        $count=1;
                        if ($result-> num_rows > 0){
                            while ($row=$result-> fetch_assoc()) {                           
                                ?>
                                    <tr>
                                        <td><?=$count?></td>
                                        <td><?=$row["userName"]?></td>
                                        <td><?=$row["email"]?></td>
                                        <td><?=$row["pNumber"]?></td>
                                        <td><?=$row["address"]?></td>
                                        <td><?=$row["nic"]?></td>
                                        <td>
                                            <button onclick="location.href='editUser.php?email=<?=$row['email']?>'">📝</button>
                                            <button onclick="deleteUser('<?=$row['email']?>')">❌</button>
                                        </td>
                                    </tr>
                                <?php
                                $count=$count+1;
                            }
                        }
                    ?>
                </table>
            </div>
            <div>
                <button onclick="location.href='adminPage.php'">Back</button>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; Journey Snaps 2024</p>
    </footer>

    <script>
        function deleteUser(email) {
            if (confirm("Are you sure you want to delete this user?")) {
                location.href = 'Model/deleteUser.php?email=' + email;
            }
        }
    </script>
</body>
</html>