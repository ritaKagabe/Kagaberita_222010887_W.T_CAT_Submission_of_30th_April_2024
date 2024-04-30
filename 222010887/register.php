<?php
// Connection details
require_once "./connection/conn.php";

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $studentid  = $_POST['studentid '];
    $names = $_POST['names'];
    $email = $_POST['email'];
    $password =$_POST['password'];
    
    // Preparing SQL query
    $sql = "INSERT INTO student (studentid, names, email,password ) 
    VALUES ('$studentid','$names','$email','$password')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
        header("Location: userlogin.php");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>
