<?php
require_once "./connection/conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $feedbackid = $_POST['feedbackid'];

    // Delete claim record
    $sql = "DELETE FROM feedback WHERE feedbackid=$feedbackid";

    if ($connection->query($sql) === TRUE) {
        echo "feedback deleted successfully";
    } else {
        echo "Error deleting feedback record: " . $connection->error;
    }

    // Redirect to viewfeedback.php after deletion
    header("Location: viewfeedback.php");
    exit; // Stop further execution after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete feedback</title>
</head>
<body>
    <h2>Delete feedback</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="feedbackid">Select feedback to Delete:</label>
        <select name="feedbackid">
            <?php
            
            $sql = "SELECT * FROM feedback";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['feedbackid'] . "'>" . $row['feedbackid'] . "</option>"; // Close the value attribute with a quotation mark
                }
            } else {
                echo "<option value=''>No feedbacks available</option>";
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
