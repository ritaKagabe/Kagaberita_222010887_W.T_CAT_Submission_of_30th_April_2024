<?php
    session_start();
    if(isset($_SESSION['student'])){
      header('location: userhome.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student's Home Page</title>
    <style>
 
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color:brown;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo-container img {
            height: 40px; 
            width: 100px;
            margin-left: 20px; 
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
        }
        nav a:hover {
            background-color: #555;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 120px;
            z-index: 1;
        }
        .dropdown-content a {
            color: #fff;
            padding: 6px 10px;
            display: block;
            text-decoration: none;
        }
        .dropdown-content a:hover {
            background-color: #555;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        footer {
            background-color:brown;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }


        main {
            display: flex;
            justify-content: space-between;
            margin: 20px auto;
            max-width: 1200px;         }

        main img {
            height: 400px;
            width: 48%; 
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="image/logo.jpg" alt="Logo">
        </div>
        <a href="userhome.php">Home</a>
        <a href="claims.html">claims</a>
        <a href="viewnotification.php">notification</a>
        <a href="feedback.html">feedback</a>

        <div class="dropdown">
            <a href="#">menu</a>
            <div class="dropdown-content">
                <a href="userlogout.php"> student logout</a>                
            </div>
        </div>
    </nav>

    <center><h1>Welcome student!</h1></center>
    <main>
        <img src="image/students.jpg" alt="Image 1">
        <img src="image/chat.jpg" alt="Image 2">
    </main>

    <footer>
        &copy; UR CBE BIT &copy, 2024 &reg, Designer by: @Rita KAGABE.    </footer>
</body>
</html>