<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View claims Information</title>
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

    <h2>CLAIMS INFORMATION</h2>

    <table >
        <thead>
            <tr>
                <th>CLAIMID</th>
                <th>CLAIMTYPE</th>
                <th>COURSENAME</th>
                <th>DATE</th>
                <th>STUDENTID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php

require_once "./connection/conn.php";


            // Fetch bus records from the database
            $sql = "SELECT * FROM claims";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . (isset($row['claimid']) ? $row['claimid'] : '') . "</td>";
                    echo "<td>" . (isset($row['claimtype']) ? $row['claimtype'] : '') . "</td>";
                     echo "<td>" . (isset($row['coursename']) ? $row['coursename'] : '') . "</td>";
                      echo "<td>" . (isset($row['date']) ? $row['date'] : '') . "</td>";
                      echo "<td>" . (isset($row['studentid']) ? $row['studentid'] : '') . "</td>";
                    echo "<td>
                            <a href='updateclaims.php?'>Update</a>
                            <a href='deleteclaims.php'>Delete</a>
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