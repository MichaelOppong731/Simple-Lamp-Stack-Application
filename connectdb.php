<?php
require __DIR__ . '/vendor/autoload.php'; // Load Composer dependencies

// Retrieve database credentials from environment variables
$dbhost = getenv('DB_HOST') ?: die("Error: Missing DB_HOST");
$dbuser = getenv('DB_USER') ?: die("Error: Missing DB_USER");
$dbpass = getenv('DB_PASS') ?: ''; // Password might be empty
$dbname = getenv('DB_NAME') ?: die("Error: Missing DB_NAME");

// Establish database connection
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
