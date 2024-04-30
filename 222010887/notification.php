<?php
require_once "./connection/conn.php";

// Prepare and bind the SQL statement
$stmt = $connection->prepare("INSERT INTO notification (notificationid, message, date, studentid) VALUES (?, ?, ?, ?)");

// Check if the statement was prepared successfully
if (!$stmt) {
    die("Error: " . $connection->error);
}

// Bind parameters to the prepared statement
$stmt->bind_param("isss", $notificationid, $message, $date, $studentid);

// Set parameters from the form submission
$notificationid = $_POST['notificationid'];
$message = $_POST['message'];
$date = $_POST['date'];
$studentid = $_POST['studentid'];

// Execute the statement
if ($stmt->execute()) {
    echo "New notification created successfully";
    header("Location: staffhome.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$connection->close();
?>
