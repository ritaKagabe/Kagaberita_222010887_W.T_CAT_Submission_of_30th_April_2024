<?php
// Start session
session_start();

require_once "./connection/conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $email = $connection->real_escape_string($_POST['email']);
    $password = $connection->real_escape_string($_POST['password']);

    // Check if the user is an admin
    $admin_query = "SELECT * FROM staff WHERE email='$email' AND password='$password'";
    $admin_result = $connection->query($admin_query);

    if ($admin_result->num_rows > 0) {
        // Set session variables for admin
        $_SESSION['admin'] = 'staff';
        $_SESSION['email'] = $email;
        // Redirect to admin dashboard or index page
        header("Location: staffhome.php");
        exit();
    } 
    else {
        // Invalid login credentials
        $error = "Invalid email or password please create a create";
    }
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <style>
             body {
    font-family: Arial, sans-serif;
    background-color:whitesmoke;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin-top: 50px;
    color: #333;
}

form {
    max-width: 400px;
    margin: 0 auto;
    background-color: lightseagreen;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

     </style>
</head>
<body>
    <h2>staff login</h2>
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
        <button><a href="register.html">signup</button>
    </form>
</body>
</html>