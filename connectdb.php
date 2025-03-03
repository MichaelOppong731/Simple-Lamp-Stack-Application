<?php
dbhost = 'lampstack.c18g4q48md9n.eu-west-1.rds.amazonaws.com'; 
dbuser = 'admin'; 
dbpass = 'rootpassword';
dbname = 'lampstack';
$connection = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
if (mysqli_connect_errno()) {
     die("database connection failed :" .
     mysqli_connect_error() .
     "(" . mysqli_connect_errno() . ")"
         );
    }
?>
