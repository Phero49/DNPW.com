<?php
  $directory = '../Invoices';
  $pdfFiles = scandir($directory);

  // Filter for PDF files
  $pdfFiles = array_filter($pdfFiles, function($file) {
      return preg_match('/\.pdf$/i', $file);
  });
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/Head.png">
    <title>Journey Snaps|Admin|Sales</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <h2>Invoice List</h2>
            <ul>
                <?php
                    foreach ($pdfFiles as $file) :
                ?>
                <li><a href="../Invoices/<?= $file ?>" target="_blank">
                        <?= $file ?>
                    </a></li>
                <?php 
                    endforeach; 
                ?>
            </ul>
            <div>
                <button onclick="location.href='adminPage.php'">Back</button>
            </div>       
        </section>
    </main>

    <footer>
        <p>&copy; Journey Snaps 2024</p>
    </footer>
</body>
</html>
