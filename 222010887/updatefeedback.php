<?php
require_once "./connection/conn.php";

// Fetch data from the feedback table
$sql = "SELECT * FROM feedback";
$result = $connection->query($sql);

// Check if the form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve the submitted form data
    $feedbackid = $connection->real_escape_string($_POST['feedbackid']);
    $message = $connection->real_escape_string($_POST['message']);
    $studentid = $connection->real_escape_string($_POST['studentid']);

    // Update the feedback record in the database
    $update_sql = "UPDATE feedback SET message='$message', studentid='$studentid' WHERE feedbackid='$feedbackid'";

    if ($connection->query($update_sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'viewfeedback.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating record: " . $connection->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['feedbackid'])) {
    $feedbackid = $connection->real_escape_string($_GET['feedbackid']);
    $select_sql = "SELECT * FROM feedback WHERE feedbackid='$feedbackid'";
    $result_update = $connection->query($select_sql);

    if ($result_update) {
        if ($result_update->num_rows == 1) {
            // Fetch the feedback data to pre-fill the update form
            $row = $result_update->fetch_assoc();
            $message = $row['message'];
            $studentid = $row['studentid'];
        } else {
            echo "Feedback not found";
            exit;
        }
    } else {
        echo "Error executing query: " . $connection->error;
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Feedback</title>
</head>
<body>
    <h2>Feedback Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="feedbackid">Enter Feedback ID:</label>
        <input type="text" id="feedbackid" name="feedbackid" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($feedbackid)) : ?>
        <h1>Update Feedback Information</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="feedbackid" value="<?php echo $feedbackid; ?>">
            <label for="message">Message:</label>
            <input type="text" id="message" name="message" value="<?php echo $message; ?>" required><br><br>
            <label for="studentid">Student ID:</label>
            <input type="number" id="studentid" name="studentid" value="<?php echo $studentid; ?>" required><br><br>
            <button type="submit" name="update">Update</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php $connection->close(); ?>
