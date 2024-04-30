<?php
require_once "./connection/conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Collect form data
    $claimid = $_POST['claimid'];

    // Delete claim record
    $sql = "DELETE FROM claims WHERE claimid=$claimid";

    if ($connection->query($sql) === TRUE) {
        echo "Claim deleted successfully";
    } else {
        echo "Error deleting claim record: " . $connection->error;
    }

    // Redirect to viewclaims.php after deletion
    header("Location: viewclaims.php");
    exit; // Stop further execution after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Claims</title>
</head>
<body>
    <h2>Delete Claim</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="claimid">Select claim to Delete:</label>
        <select name="claimid">
            <?php
            // Fetch claim records
            $sql = "SELECT * FROM claims";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['claimid'] . "'>" . $row['claimid'] . "</option>"; // Close the value attribute with a quotation mark
                }
            } else {
                echo "<option value=''>No claims available</option>";
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
