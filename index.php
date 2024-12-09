<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Images/logo2.png">
    <title>DNPW| Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Styles/styles.css">
    <script src="Scripts/cart.js" defer></script>
</head>
<body>
        <?php
            session_start();
        ?>
    <nav>
        <a href="index.php">
            <img src="Images/parks logo.png" alt="Logo">
        </a>
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="hamburger">&#9776;</label>
        <ul class="menu">
            
            <li><a href="places.php">Places</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">About Us</a></li>
          
        </ul>
    </nav>

    <main class="Index">
        <section>
            
            <h2>Department of Parks and Wildlife</h2>
            <p>"Your efforts to protect wildlife and preserve nature are critical to the future of our planet." </p>
             <?php /*
                if (isset(_SESSION['userName'])) {
                   echo '<button><a href="gallery.php" style="color: #fff;">Shop Now</a></button>';
                }else {
                    echo '<button><a href="login.php" style="color: #fff;">Login</a></button>';
                } */
            ?> 
            <button onclick="location.href='stories.php'">Stories</button>
            <button onclick="location.href='gallery.php'">Gallery</button>
        </section>
    </main>

    <footer>
        <p>&copy; Department of Parks and worldlife 2024</p>
    </footer>
</body>
</html>


