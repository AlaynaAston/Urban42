<?php 
require 'testdb.php';
session_start();
if(!isset($_SESSION["userID"])) {
            header("Location: login.php");
            exit();
        }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="navbarstyling.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <!-- NAVBAR -->
<div class="navbar">

<div class="nav-left">

<div class="sidebar-icon">
<span class="bar"></span>
<span class="bar"></span>
<span class="bar"></span>
</div>

<div class="brand-logo">
<img src="urban42.png" alt="Urban 42 Logo">
<span>Urban 42</span>
</div>

</div>

<div class="nav-right">

<img src="ukflag.jpg" alt="UK Flag" class="flag-icon">
<span>GBP £</span>

<a href="ContactPage.php">Help</a>
<a href="<?php if(isset($_SESSION['userID']))
    {echo("logout.php");} else{echo("login.php");}?>"><?php if(isset($_SESSION['userID'])){echo("Log Out");} else{echo("Log In");}?></a>

<button id="theme-toggle" class="theme-toggle">🌙</button>

<form class="search-form" action="search.php" method="GET">
<input type="text" placeholder="Search..." name="search" class="nav-search">
<button type="submit">🔍</button>
</form>

<a href="basket.php">Cart</a>

</div>
</div>

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
        <a href="Profile.php">Your Account</a>
        <a href="index.php">Home</a>
        <a href="aboutus.php">About Us</a>
        <a href="Productlist.php">Shop</a>
        <a href="#">New Arrivals</a>
        <a href="#">Sale</a>
        <a href="ContactPage.php">Contact Us</a>
    </div><!--end of the navigation bar-->
</body>
</html>