<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (isset($_POST['claimid'], $_POST['claimtype'], $_POST['coursename'], $_POST['date'], $_POST['studentid'])) {

require_once "./connection/conn.php";

        // Prepare and bind the SQL statement
        $stmt = $connection->prepare("INSERT INTO claims (claimid, claimtype, coursename, date, studentid) VALUES (?, ?, ?, ?, ?)");

        // Check if the statement was prepared successfully
        if (!$stmt) {
            die("Error: " . $connection->error);
        }

        // Bind parameters to the prepared statement
        $stmt->bind_param("issss", $claimid, $claimtype, $coursename, $date, $studentid);

        // Set parameters from the form submission
        $claimid = $_POST['claimid'];
        $claimtype = $_POST['claimtype'];
        $coursename = $_POST['coursename'];
        $date = $_POST['date'];
        $studentid = $_POST['studentid'];

        // Execute the statement
        if ($stmt->execute()) {
            echo "New claim created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $connection->close();
    } else {
        // If required fields are missing
        echo "All fields are required.";
    }
} else {
    // If the form is not submitted
    echo "Form not submitted.";
}
?>
