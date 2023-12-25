<?php include 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
        <h1 class="logo"><span class="big_k">K</span>LUMNI</h1>
    
        <ul class='navbar_list'>
            <li class='navbar_list_item'><a href="/">Home</a></li>
            <li class='navbar_list_item'><a href="/registration.php">Register</a></li>
            <?php
            // Check if the user is logged in
            if(isset($_SESSION['name'])):
            ?>
            <li class='navbar_list_item'><a href="logout.php">Logout</a></li>
            <?php else: ?>
            <li class='navbar_list_item'><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
