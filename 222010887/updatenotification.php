<?php
require_once "./connection/conn.php";

// Fetch data from the notification table
$sql = "SELECT * FROM notification";
$result = $connection->query($sql);

// Check if the form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve the submitted form data
    $notificationid = $connection->real_escape_string($_POST['notificationid']);
    $message = $connection->real_escape_string($_POST['message']);
    $date = $connection->real_escape_string($_POST['date']);
    $studentid = $connection->real_escape_string($_POST['studentid']);

    // Update the notification record in the database
    $update_sql = "UPDATE notification SET message='$message', date='$date', studentid='$studentid' WHERE notificationid='$notificationid'";

    if ($connection->query($update_sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'viewnotification.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating record: " . $connection->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['notificationid'])) {
    $notificationid = $connection->real_escape_string($_GET['notificationid']);
    $select_sql = "SELECT * FROM notification WHERE notificationid='$notificationid'";
    $result_update = $connection->query($select_sql);

    if ($result_update) {
        if ($result_update->num_rows == 1) {
            // Fetch the notification data to pre-fill the update form
            $row = $result_update->fetch_assoc();
            $message = $row['message'];
            $date = $row['date'];
            $studentid = $row['studentid'];
        } else {
            echo "Notification not found";
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
    <title>Update Notification</title>
</head>
<body>
    <h2>Notification Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="notificationid">Enter notificationid:</label>
        <input type="text" id="notificationid" name="notificationid" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($notificationid)) : ?>
        <h1>Update Notification Information</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="notificationid" value="<?php echo $notificationid; ?>">
            <label for="message">Message:</label>
            <input type="text" id="message" name="message" value="<?php echo $message; ?>" required><br><br>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br><br>
            <label for="studentid">Student ID:</label>
            <input type="number" id="studentid" name="studentid" value="<?php echo $studentid; ?>" required><br><br>
            <button type="submit" name="update">Update</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php $connection->close(); ?>
