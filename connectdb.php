<?php
require __DIR__ . '/vendor/autoload.php'; // Load Composer dependencies

use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve database credentials
$dbhost = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
$dbuser = $_ENV['DB_USER'] ?? getenv('DB_USER');
$dbpass = $_ENV['DB_PASS'] ?? getenv('DB_PASS');
$dbname = $_ENV['DB_NAME'] ?? getenv('DB_NAME');

// Ensure all required variables are set
if (!$dbhost || !$dbuser || !$dbname) {
    die("Error: Missing required database environment variables.");
}

// Establish database connection
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
