<?php
$dbhost = getenv('DB_HOST'); 
$dbuser = getenv('DB_USER'); 
$dbpass = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');
$connection = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
if (mysqli_connect_errno()) {
     die("database connection failed :" .
     mysqli_connect_error() .
     "(" . mysqli_connect_errno() . ")"
         );
    }
?>
