<?php
$dbhost = "lampstack-proxy.proxy-cbai0mmqgx0g.eu-west-1.rds.amazonaws.com";
$dbuser= "root";
$dbpass = "rootpassword";
$dbname = "assign2db";
$connection = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
if (mysqli_connect_errno()) {
     die("database connection failed :" .
     mysqli_connect_error() .
     "(" . mysqli_connect_errno() . ")"
         );
    }
?>
