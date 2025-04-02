<?php
require __DIR__ . '/vendor/autoload.php';

// Get the entire secret as JSON
$secretJson = getenv('DB_SECRET') ?: die("Error: Missing DB_SECRET");
$secret = json_decode($secretJson, true);

// Extract values
$dbhost = $secret['DB_HOST'] ?? die("Error: Missing DB_HOST in secret");
$dbuser = $secret['DB_USER'] ?? die("Error: Missing DB_USER in secret");
$dbpass = $secret['DB_PASS'] ?? '';
$dbname = $secret['DB_NAME'] ?? die("Error: Missing DB_NAME in secret");

// Establish connection
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>