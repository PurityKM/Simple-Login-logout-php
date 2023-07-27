<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header-container">
    <nav class="nav">
        <a href="">System</a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="discover.php">About Us</a></li>
            <li><a href="blog.php">Find Blogs</a></li>

            <?php

            if(isset($_SESSION["unameId"])) {
                echo "<li><a href='profile.php'>Profile</a></li>";
                echo "<li><a href='includes/logout.php'>Logout</a></li>";
            }
            else {
                echo "<li><a href='signup.php'>SignUp</a></li>";
                echo "<li><a href='login.php'>Login</a></li>";
            }

            ?>
        </ul>
    </nav>

</header>