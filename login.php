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
        $_SESSION["user_id"] = $user["userID"];
        $_SESSION["user_email"] = $email;

        header("Location: dashboard.php");
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

<!-- ================= NAVBAR (updated to match cart) ================= -->
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
    <img src="ukflag.jpg" class="flag-icon">
    <span>GBP £</span>

    <a href="ContactPage.php">Help</a>
    <a href="login.html">Log in</a>
    <a href="basket.html">Cart</a>
  </div>
</div>
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