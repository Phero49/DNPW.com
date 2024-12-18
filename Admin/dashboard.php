<?php
// Start the session
session_start();
ini_set('display_errors', 1);
require_once "../Database/dbConfig.php";

if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];


} else {
  header('Location:./adminLogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../Images/logo2.png">
  <title>Dash board </title>
  <link rel="stylesheet" href="../Styles/styles.css">

</head>

<body>
<nav>
    <a href="index.php">
      <img src="../Images/parks logo.png" alt="Logo">
    </a>
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="hamburger">&#9776;</label>
    <ul class="menu">
      <li><a href="?page=images">manage images</a></li>
      <li><a href="?page=news#drafts">manage news</a></li>
      <li><a href="?page=projects">manage projects</a></li>
      <?php
      if (isset($_SESSION['userName'])) {
        echo '<li><a href="cart.php"><i class="fas fa-shopping-cart"></i><span id="cart-count"></span></a></li>';
        echo '<li><a href="userProfile.php"><i class="fas fa-user"></i></a></li>';
      }
      ?>
    </ul>
  </nav>

    <!-- Side Navbar -->
   

    <div class="main-content">
      <?php
      $page = isset($_GET['page']) ? $_GET['page'] : false;
      if ($page) {
        switch ($page) {
          case 'news':
            include "./news.php";
            break; 
            
            case 'images':
              include "./adminPage.php";
            break;
          
          default:
         echo "<h1>Page Not Found</h1><p>The requested page does not exist.</p>";
            break;
        }
      }else{
        echo "<h1>Page Not Found</h1><p>The requested page does not exist.</p>";

      }

      ?>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="../Scripts/dashboard.js">

  </script>


</body>

</html>