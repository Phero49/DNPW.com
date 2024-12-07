<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Images/logo2.png">
    <title>DNPW| About</title>
    <script src="Scripts/contact.js" defer></script>
    <script src="Scripts/cart.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="stylesheet" href="Styles/contact.css">
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
            <?php
                if (isset($_SESSION['userName'])) {
                   echo '<li><a href="gallery.php">Gallery</a></li>';
                } 
            ?>
            <li><a href="places.php">Places</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">About Us</a></li>
            <?php
                if (isset($_SESSION['userName'])) {
                    echo '<li><a href="cart.php"><i class="fas fa-shopping-cart"></i><span id="cart-count"></span></a></li>';
                    echo '<li><a href="userProfile.php"><i class="fas fa-user"></i></a></li>';
                } 
            ?>
        </ul>
    </nav>

    <!-- About Us Section -->
    <section class="about-us">
        <h2>About Us</h2>
        <div class="about-content">
            <img src="Images/logo2.png">
            <p class="slogan">"Your efforts to protect wildlife and preserve nature are critical to the future of our planet." </p>
            <p class="description">
            The Department of National Parks and Wildlife (DNPW) is one of the departments 
            under the Ministry of Natural Resources, Energy and Mining and is responsible for the 
            management and conservation of wildlife resources in Malawi. Our mission is to conserve and manage 
            protected areas and wildlife for present and future Malawians through enforcement of wildlife legislation, adaptive management, 
            effective monitoring and governance.<br>Our team is dedicated to creativity, quality, and delivering value to our clients.
            </p>
            <ul class="contact-info">  
                <li>Department of National Parks and Wildlife</li>
                   <li> Matamando House, Convention Drive<li>
                    <li> City Centre </li>
                    <li>PO Box 30131</li>
                    <li>Lilongwe 3</li>
                <li>Phone: +265 (0) 1759 831</li>
                <li>Email: dpw@wildlifemw.net</li>
            </ul>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="contact-us">
        <h2>Contact Us</h2>
        <form action="Model/getContact.php" method="POST" class="contact-form" onsubmit="return validateContactForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5"></textarea>
            </div>
            <div class="form-buttons">
                <button type="submit" class="send-btn">Send</button>
                <button type="reset" class="cancel-btn">Cancel</button>
            </div>
        </form>
    
        <!-- Validation and Success Modals -->
        <div id="validationModal" class="modal">
            <div class="modal-content">
                <h3 id="modalMessage"></h3>
                <button class="close-btn" onclick="closeModal('validationModal')">Close</button>
            </div>
        </div>
    
        <div id="successModal" class="modal">
            <div class="modal-content">
                <h3 id="modalMessage"></h3>
            </div>
        </div>
    
    </section>

    <footer>
        <p>&copy; Department of Parks and worldlife 2024</p>
    </footer>
</body>
</html>
