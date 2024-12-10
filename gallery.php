<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="Images/logo2.png">
  <title>DNPW| Gallery</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="Styles/styles.css">
  <link rel="stylesheet" href="Styles/gallery.css">
  <script src="Scripts/cart.js" defer></script>
  <script src="Scripts/gallery.js" defer></script>
</head>

<body>
  <?php
  require_once "./Database/dbConfig.php";

  ?>
  <nav>
    <a href="index.php">
      <img src="Images/parks logo.png" alt="Logo">
    </a>
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="hamburger">&#9776;</label>
    <ul class="menu">
      <li><a href="gallery.php">Gallery</a></li>
      <li><a href="places.php">Places</a></li>
      <li><a href="contact.php">About Us</a></li>
      <?php
      if (isset($_SESSION['userName'])) {
        echo '<li><a href="cart.php"><i class="fas fa-shopping-cart"></i><span id="cart-count"></span></a></li>';
        echo '<li><a href="userProfile.php"><i class="fas fa-user"></i></a></li>';
      }
      ?>
    </ul>
  </nav>

  <div class="slider">

    <?php
      // Connect to the database
      $pdo = connectToDatabase();

      // Fetch the first 50 image records ordered by time
      $res = $pdo->query('SELECT  `path`, `user`, `time`,`title`,`caption` FROM `images` ORDER BY time DESC LIMIT 50');

      // Validate the query result
      if ($res) {
        $data = $res->fetchAll(); // Fetch all records
      


        // Check if rows are available
        if ($res->rowCount() > 0) {
          $count = 0;
          // Loop through each image record
          foreach ($data as $value) {
           

            ?>
    <div class="slide <?php echo $count  > 0 ? ""  : 'current'  ?>" style="background: url(<?php  echo './Database/read-image.php?img='. htmlspecialchars($value['path']); ?>) no-repeat center center/cover;">
      <div class="content">
        <h1><?php echo htmlspecialchars($value['title']); ?></h1>
        <p>"<?php echo htmlspecialchars($value['caption']); ?>"</p>
      </div>

    </div>
    <?php

$count++;    }}}
          ?>
   
  </div>


  <div class="buttons">
    <button id="prev"><i class="fas fa-arrow-left"></i></button>
    <button id="next"><i class="fas fa-arrow-right"></i></button>
  </div>

  <div class="MainGallery">
    <div class="gallery">
      <?php
      // Connect to the database
      $pdo = connectToDatabase();

      // Fetch the first 50 image records ordered by time
      $res = $pdo->query('SELECT `id`, `path`, `user`, `time`,`title` FROM `images` ORDER BY time DESC LIMIT 50');

      // Validate the query result
      if ($res) {
        $data = $res->fetchAll(); // Fetch all records
      


        // Check if rows are available
        if ($res->rowCount() > 0) {
          // Loop through each image record
          foreach ($data as $value) {
            ?>
            <div class="photo-item">
              <!-- Dynamically set image source and alt text -->
               <div class="flex-center">
                   <img style="border-radius:10px;" src="<?php echo './Database/read-image.php?img='. htmlspecialchars($value['path']); ?>"
                alt="<?php echo htmlspecialchars($value['title']); ?>">
               </div>
           
              <div class="photo-details">
                <!-- Display title -->
                <p><strong><?php echo htmlspecialchars($value['title']); ?></strong></p>
              </div>
            </div>
            <?php
          }
        }
      }
      ?>
    </div>
  </div>
  </div>


  <footer>
    <p>&copy; Department of Parks and worldlife 2024</p>
  </footer>
</body>

</html>