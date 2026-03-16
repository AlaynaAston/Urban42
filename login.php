<?php
session_start();
require 'db.php';

if (!isset($_SESSION["login_attempts"])) {
    $_SESSION["login_attempts"] = 0;
}

if ($_SESSION["login_attempts"] >= 5) {
    exit("Too many attempts. Try later.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        exit("Enter email and password.");
    }

    $stmt = $db->prepare("
        SELECT userID, passwordHash 
        FROM Users 
        WHERE email = ?
    ");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["passwordHash"])) {

        $_SESSION["login_attempts"] = 0;
        $_SESSION["userID"] = $user["userID"];
        $_SESSION["email"] = $email;

        header("Location: index.php");
        exit();

    } else {
        $_SESSION["login_attempts"]++;
        exit("Invalid email or password.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Log In — Urban 42</title>

  <!-- Main Styles -->
  <link rel="stylesheet" href="rahmanstyle.css">

  <!-- Chatbox Styles -->
  <link rel="stylesheet" href="chatbox.css">

</head>
<body>

 <!-- NAVBAR (original, unchanged) -->
   <div class="navbar"> <!--main navigation bar container-->
    <div class="nav-left"> <!--left side of the navigation bar-->
    <div class="sidebar-icon"> <!--button that users will click to open the side menu-->
      <span class="bar"></span> <!--horizontal line 1 that creates the button-->
      <span class="bar"></span> <!--line 2-->
      <span class="bar"></span> <!--line 3-->
    </div>
    <div class="brand-logo"> <!--container that has logo and brand name in it-->
      <img src="urban42.png" alt="Urban 42 Logo"> <!--shows the brand logo-->
      <span>Urban 42</span> <!--displays the brand name-->
    </div>
    </div>
    <div class="nav-right"> <!--right side of the navigation bar-->
        <img src="ukflag.jpg" alt="UK Flag" class="flag-icon"> <!--shows a UK flag icon-->
        <span>GBP £</span> <!--shows the currency-->
        <a href="ContactPage.php">Help</a> <!--link to the help page-->
        <a href="login.php">Log in</a> <!--link to the login page-->
        <button id="theme-toggle" class="theme-toggle">🌙</button>
        <form class="search-form"> <!--the search bar form-->
        <input type="text" placeholder="Search..." name="search" class="nav-search"> <!--box where the user types what they want to search-->
        <button type="submit">🔍</button> <!--button that user clicks to start the searching-->
        </form>
        <a href="basket.php">Cart</a> <!--link that takes user to the shopping cart-->
    </div>
    </div> 
    <div id="sidebar" class="sidebar">
        <a href="Profile.php">Your Account</a>
        <a href="index.php">Home</a>
        <a href="aboutus.php">About Us</a>
        <a href="index.php">Shop</a>
        <a href="#">New Arrivals</a>
        <a href="#">Sale</a>
        <a href="ContactPage.php">Contact Us</a>
    </div><!--end of the navigation bar-->
    
<!-- ================================================================ -->

<div class="container">
  <h1>Log In</h1>

  <form id="loginForm" method="POST" action="">

  <input type="email" name="email" placeholder="Email address" required>

  <input type="password" name="password" placeholder="Password" required>

  <div class="remember-wrapper">
    <label>
      <input type="checkbox" name="remember">
      Keep me signed in
    </label>
  </div>

  <button type="submit">Log In</button>
</form>

  <p style="text-align:center; margin-top:15px;">
    New here? <a href="signup.php">Create an account</a>
  </p>
</div>


<!-- ================= CHATBOX ================= -->
<div class="u42-chat-system">

  <div class="u42-chat-toggle" onclick="toggleChat()">💬</div>

  <div class="u42-chatbox" id="chatbox">
    <div class="u42-chat-header">
      Urban 42 Support
      <span onclick="toggleChat()">✕</span>
    </div>

    <div class="u42-chat-messages" id="chatMessages"></div>

    <div class="u42-chat-input-area">
      <input type="text" id="chatInput" placeholder="Ask us something...">
      <button onclick="sendMessage()">Send</button>
    </div>
  </div>

</div>

<!-- Chatbox Script -->
<script src="chatbox.js"></script>

</body>
</html>