<?php
// Database connection parameters
require_once "./connection/conn.php";

// Prepare and bind the SQL statement
$stmt = $connection->prepare("INSERT INTO staff (staffid, names, position, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $staffid, $names, $position, $email, $password);

// Set parameters from the form submission
$staffid = $_POST['staffid'];
$names = $_POST['names'];
$position = $_POST['position'];
$email = $_POST['email'];
$password = $_POST['password'];

if ($stmt->execute()) {
    echo "New record created successfully";

} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$connection->close();
?>
