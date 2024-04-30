<?php
require_once "./connection/conn.php";

// Prepare and bind the SQL statement
$stmt = $connection->prepare("INSERT INTO feedback (feedbackid, message, studentid) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $feedbackid, $message, $studentid);

// Set parameters from the form submission
$feedbackid = $_POST['feedbackid'];
$message = $_POST['message'];
$studentid = $_POST['studentid'];

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
    header("Location: userhome.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$connection->close();
?>
