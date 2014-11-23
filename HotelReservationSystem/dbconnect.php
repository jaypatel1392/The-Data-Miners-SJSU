<?php

/**
First make sure that our schema is already on the database. 
**/

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "jat_reservation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>