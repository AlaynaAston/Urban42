<?php
session_start();
require 'testdb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullName = trim($_POST["fullName"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm_password"]);
    $phone = trim($_POST["phone"]);
    $title = trim($_POST["title"]);
    $dob = $_POST["dob"];

    // Validation
    if (empty($email) || empty($password) || empty($confirm)) {
        exit("Please fill required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Invalid email.");
    }

    if (strlen($password) < 8) {
        exit("Password must be at least 8 characters.");
    }

    if ($password !== $confirm) {
        exit("Passwords do not match.");
    }

    // Check existing email
    $check = $db->prepare("SELECT userID FROM Users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        exit("Email already registered.");
    }

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $insert = $db->prepare("
        INSERT INTO Users (fullName, email, passwordHash, phone, title, dob)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $insert->execute([
        $fullName ?: null,
        $email,
        $passwordHash,
        $phone ?: null,
        $title ?: null,
        $dob ?: null
    ]);

    $_SESSION["user_id"] = $db->lastInsertId();
    $_SESSION["user_email"] = $email;

    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Account — Urban 42</title>

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
  <a href="index.html">Home</a>
  <a href="aboutus.php">About Us</a>
  <a href="#">Shop</a>
  <a href="#">New Arrivals</a>
  <a href="#">Sale</a>
  <a href="ContactPage.php">Contact Us</a>
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
  <h1>Create Account</h1>

  <form id="signupForm" method="POST" action="">

  <select name="title" required>
    <option value="">Title</option>
    <option>Mr</option>
    <option>Ms</option>
    <option>Mrs</option>
    <option>Other</option>
  </select>

  <input type="text" name="fullName" placeholder="Full name" required>

  <input type="email" name="email" placeholder="Email address" required>

  <input type="password" name="password" placeholder="Password (min 8 characters)" minlength="8" required>

  <input type="password" name="confirm_password" placeholder="Confirm password" minlength="8" required>

  <input type="date" name="dob" required>

  <input type="tel" name="phone" placeholder="Mobile number" required>

  <div class="checkbox-row">
    <input type="checkbox" id="tos" required>
    <label for="tos">I agree to the Terms & Conditions</label>
  </div>

  <button type="submit">Create Account</button>
</form>

<!-- ================= Sidebar functionality ================= -->
<script> 
    document.querySelector(".sidebar-icon").addEventListener("click", () => {
    document.getElementById("sidebar").classList.toggle("open");
    });
    document.addEventListener("click", (e) => {
    const sidebar = document.getElementById("sidebar");
    const icon = document.querySelector(".sidebar-icon");

  // If clicking outside the sidebar AND not clicking the icon
    if (!sidebar.contains(e.target) && !icon.contains(e.target)) {
      sidebar.classList.remove("open");
    }
  });
  </script>

<!-- ================= Theme toggle functionality ================= -->
  <script>
  const toggleBtn = document.getElementById("theme-toggle");

  if (localStorage.getItem("theme") === "dark") { //this checks if the user previously chose dark mode. If yes, it turns dark mode back on when the page loads.
    document.body.classList.add("dark-mode"); //turns the dark mode on.
    toggleBtn.textContent = "☀️"; //shows the button with sun icon.
  }

  toggleBtn.addEventListener("click", () => {  //this runs when the user clicks dark mode button which is moon icon.
    document.body.classList.toggle("dark-mode"); //makes the theme switch between dark mode and light mode.

    const isDark = document.body.classList.contains("dark-mode"); //checks if dark mode is currently active.
    toggleBtn.textContent = isDark ? "☀️" : "🌙"; //changes the icon on button depending on the mode. Sun means dark mode is on and Moon means light mode is on.

    localStorage.setItem("theme", isDark ? "dark" : "light"); //it saves the user's choice so the website remembers it next time.
  });
</script>


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