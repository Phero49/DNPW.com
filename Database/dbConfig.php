<?php



require_once './vendor/autoload.php';

use Dotenv\Dotenv;
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

function connectToDatabase() {
    // Load environment variables from .env

    // Retrieve DB credentials from environment variables
    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $dbname = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    try {
        // Create a PDO instance
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $password);

        // Set error mode to exception for better error handling
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("CREATE TABLE IF NOT EXISTS `wild_parks`.`users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `password_hash` VARCHAR(100) NOT NULL,
    `last_login` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
");

$pdo->exec("CREATE TABLE IF NOT EXISTS `wild_parks`.`images`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `path` VARCHAR(200) NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    `caption` MEDIUMTEXT NOT NULL,
    `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `user` INT NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;");
        return  $pdo;
    } catch (PDOException $e) {
        echo "<h1>db connection failed</h1>";
        // Handle connection error
        die("Database connection failed: " . $e->getMessage());
    }
}
