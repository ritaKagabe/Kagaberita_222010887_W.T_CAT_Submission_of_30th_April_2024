<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View feedback Information</title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <style>
        body {
            text-align: center; 
        }
        table {
            width: 70%; 
            margin: 0 auto; 
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid lightpink;
            padding: 8px;
            text-align: left;
            background-color: pink;
        }

        th {
            background-color: darkgray;
        }
    </style>
</head>
<body>

    <h2>FEED BACK INFORMATION</h2>

    <table >
        <thead>
            <tr>
                <th>FEEDBACKID</th>
                <th>STUDENTID</th>
                <th>MESSAGE</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
require_once "./connection/conn.php";


            // Fetch bus records from the database
            $sql = "SELECT * FROM feedback";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . (isset($row['feedbackid']) ? $row['feedbackid'] : '') . "</td>";
                    echo "<td>" . (isset($row['studentid']) ? $row['studentid'] : '') . "</td>";
                     echo "<td>" . (isset($row['message']) ? $row['message'] : '') . "</td>";
                    echo "<td>
                            <a href='updatefeedback.php?'>Update</a>
                            <a href='deletefeedback.php'>Delete</a>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }

            // Close the database connection
            $connection->close();
            ?>
        </tbody>
    </table>

 
    <button type="button" onclick="location.href='staffhome.php';">Go Back</button>

</body>
</html>