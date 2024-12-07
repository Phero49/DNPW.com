<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/Head.png">
    <title>Journey Snaps|Admin|MSGs</title>
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
                <h2>User Messages</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Message No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Message</th>
                        </tr>
                    </thead>
                    <?php
                        include_once "Model/connection.php";
                        $sql="SELECT * from msg";
                        $result=$conn-> query($sql);
                        $count=1;
                        if ($result-> num_rows > 0){
                            while ($row=$result-> fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?=$count?></td>
                            <td><?=$row["name"]?></td>
                            <td><?=$row["email"]?>
                                <!-- Passing the email dynamically to the function -->
                                <span class="copy-icon" onclick="copyToClipboard('<?=$row["email"]?>')">📧</span>
                            </td>
                            <td>"<?=$row["message"]?>"</td>
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
                <div class="tooltip">
                    <a href="https://mail.google.com/" target="_blank">
                        <button>Reply</button>
                    </a>
                    <span class="tooltiptext">Please copy mail address</span>
                </div>
            </div>
            <div id="validationModal" class="modal">
                <div class="modal-content">
                    <h3 id="modalMessage"></h3>
                    <button class="close-btn" onclick="backModal()">Back</button>
                    <button class="close-btn" onclick="okModal()">Send Mail</button>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; Journey Snaps 2024</p>
    </footer>

    <script>
        let copiedEmail = '';

        // Function to copy the email address to the clipboard
        function copyToClipboard(email) {
            navigator.clipboard.writeText(email).then(() => {
                copiedEmail = email; // Store the copied email
                showModal('Email copied: ' + email);
            }).catch(err => {
                console.error('Could not copy text: ', err);
            });
        }

        function showModal(message) {
            document.getElementById("modalMessage").innerText = message;
            document.getElementById("validationModal").style.display = "flex";
        }

        function okModal() {
            document.getElementById("validationModal").style.display = "none";
            window.open('https://mail.google.com/mail/?view=cm&fs=1&to=' + copiedEmail, '_blank');
        }

        function backModal() {
            document.getElementById("validationModal").style.display = "none";
        }
    </script>
</body>
</html>
