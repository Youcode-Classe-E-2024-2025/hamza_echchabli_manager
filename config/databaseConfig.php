<?php
$host = "localhost"; 
$port = "5432"; 
$dbname = "librairie"; 
$user = "postgres"; 
$password = "hamza"; 

$conn_str = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conn = pg_connect($conn_str);

if (!$conn) {
    echo "Connection failed: " . pg_last_error();
}

// echo"work";
?>
