<?php
require_once "./connection/conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $notificationid = $_POST['notificationid'];

    // Delete claim record
    $sql = "DELETE FROM notification WHERE notificationid=$notificationid";

    if ($connection->query($sql) === TRUE) {
        echo "notification deleted successfully";
    } else {
        echo "Error deleting notificationid record: " . $connection->error;
    }

    // Redirect to viewnotification.php after deletion
    header("Location: viewnotification.php");
    exit; // Stop further execution after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete notification</title>
</head>
<body>
    <h2>Delete notification</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="notificationid">Select feedback to Delete:</label>
        <select name="notificationid">
            <?php
            
            $sql = "SELECT * FROM notification";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['notificationid'] . "'>" . $row['notificationid'] . "</option>"; // Close the value attribute with a quotation mark
                }
            } else {
                echo "<option value=''>No notification available</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>

<?php
// Close database connection
$connection->close();
?>
