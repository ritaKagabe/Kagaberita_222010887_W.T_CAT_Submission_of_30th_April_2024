<?php
$servername = "localhost";
$username = "kagaberita";
$password = "222010887";
$dbname = "student_claims";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>