<?php
require_once "./connection/conn.php";


// Fetch data from the bus table
$sql = "SELECT * FROM claims";
$result = $connection->query($sql);

// Check if the form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Retrieve the submitted form data
    $claimid = $connection->real_escape_string($_POST['claimid']);
    $claimtype = $connection->real_escape_string($_POST['claimtype']);
    $coursename = $connection->real_escape_string($_POST['coursename']);
    $date = $connection->real_escape_string($_POST['date']);
    $studentid = $connection->real_escape_string($_POST['studentid']);

    // Update the claims record in the database
    $update_sql = "UPDATE claims SET claimtype='$claimtype', coursename='$coursename', date='$date', studentid='$studentid' WHERE claimid='$claimid'";

    if ($connection->query($update_sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'viewclaims.php';</script>"; // Redirect to the view page
    } else {
        echo "Error updating record: " . $connection->error;
    }
}

// Retrieve data based on the ID from the URL parameter if available
if (isset($_GET['claimid'])) {
    $claimid = $connection->real_escape_string($_GET['claimid']);
    $select_sql = "SELECT * FROM claims WHERE claimid='$claimid'";
    $result_update = $connection->query($select_sql);

    if ($result_update->num_rows == 1) {
        // Fetch the bus data to pre-fill the update form
        $row = $result_update->fetch_assoc();
        $claimtype = $row['claimtype'];
        $coursename = $row['coursename'];
        $date = $row['date'];
        $studentid = $row['studentid'];

    } else {
        echo "claims not found";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update claims</title>
</head>
<body>
    <h2>claims Information</h2>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="claimid">Enter claimid:</label>
        <input type="text" id="claimid" name="claimid" required>
        <button type="submit">View</button>
    </form>

    <?php if (isset($claimid)) : ?>
        <h1>Update claim Information</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="claimid" value="<?php echo $claimid; ?>">
            <label for="claimtype">claimtype:</label>
            <input type="text" id="claimtype" name="claimtype" value="<?php echo $claimtype; ?>" required><br><br>
            <label for="coursename">coursename:</label>
            <input type="text" id="coursename" name="coursename" value="<?php echo $coursename; ?>" required><br><br>
            <label for="date">date:</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required><br><br>
             <label for="studentid">studentid:</label>
            <input type="number" id="studentid" name="studentid" value="<?php echo $studentid; ?>" required><br><br>
            <button type="submit" name="update">Update</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php $connection->close(); ?>