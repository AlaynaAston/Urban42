<?php
session_start();
require 'db.php';

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["userID"];

/* Wishlist */
$wishStmt = $db->prepare("
  SELECT p.name, p.productID
  FROM Wishlist w
  JOIN Product p ON w.productID = p.productID
  WHERE w.userID = ?
");
$wishStmt->execute([$userID]);
$wishlist = $wishStmt->fetchAll(PDO::FETCH_ASSOC);

/* Orders */
$orderStmt = $db->prepare("
  SELECT orderID, orderDate, status
  FROM Orders
  WHERE userID = ?
  ORDER BY orderDate DESC
");
$orderStmt->execute([$userID]);
$orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Orders — Urban 42</title> <!--text/title shown in the browser tab-->
  <link rel="stylesheet" href="Orderspagestyle.css" /> <!--connects the CSS file-->
  
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



<div class="orders-section">

<!-- ================= WISHLIST ================= -->
<section id="wishlist">
  <h2>My Wishlist</h2>

  <div class="wishlist-grid">
    <?php if ($wishlist): ?>
      <?php foreach ($wishlist as $item): ?>
        <div class="wishlist-card">
          <p><strong><?= htmlspecialchars($item["name"]) ?></strong></p>
          <form method="post" action="addBasket.php">
            <input type="hidden" name="productID" value="<?= $item["productID"] ?>">
            <button type="submit">Add to Cart</button>
          </form>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No items in wishlist.</p>
    <?php endif; ?>
  </div>
</section>

<!-- ================= CURRENT ORDERS ================= -->
<section id="current-orders">
  <h2>Current Orders</h2>

  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Date</th>
        <th>Status</th>
        <th>Tracking</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $o): ?>
        <?php if ($o["status"] !== "Delivered"): ?>
          <tr>
            <td>#<?= $o["orderID"] ?></td>
            <td><?= $o["orderDate"] ?></td>
            <td><?= $o["status"] ?></td>
            <td><a href="track.php?orderID=<?= $o["orderID"] ?>">Track</a></td>
          </tr>
        <?php endif; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<!-- ================= PREVIOUS ORDERS ================= -->
<section id="previous-orders">
  <h2>Previous Orders</h2>

  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $o): ?>
        <?php if ($o["status"] === "Delivered"): ?>
          <tr>
            <td>#<?= $o["orderID"] ?></td>
            <td><?= $o["orderDate"] ?></td>
            <td><?= $o["status"] ?></td>
          </tr>
        <?php endif; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>

<!-- ================= TRACK ORDER ================= -->
<section id="tracking">
  <h2>Track an Order</h2>
  <form method="get" action="track.php">
    <label for="tracking-id">Enter Order ID:</label>
    <input type="text" id="tracking-id" name="orderID" required>
    <button type="submit">Track</button>
  </form>
</section>

<!-- ================= RETURNS ================= -->
<div class="return-form"> <!--container for returns form-->
<section id="returns">
  <h2>Returns & Refunds</h2>
  <form method="post" action="return_request.php">
    <label>Order ID:</label>
    <input type="text" name="orderID" required>

    <label>Reason:</label>
    <select name="reason" required>
      <option value="">Select</option>
      <option value="size">Wrong Size</option>
      <option value="faulty">Faulty Item</option>
      <option value="wrong-item">Wrong Item Sent</option>
      <option value="other">Other</option>
    </select>

    <label>Additional Details:</label>
    <textarea name="details" rows="4"></textarea>

    <button type="submit">Submit Request</button>
  </form>
</section>

</div>
</div>
    
<!-- SIDEBAR SCRIPT -->
<script>
document.querySelector(".sidebar-icon").addEventListener("click", () => {
  document.getElementById("sidebar").classList.toggle("open");
});

document.addEventListener("click", (e) => {
  const sidebar = document.getElementById("sidebar");
  const icon = document.querySelector(".sidebar-icon");

  if (!sidebar.contains(e.target) && !icon.contains(e.target)) {
    sidebar.classList.remove("open");
  }
});
</script>

<!-- THEME TOGGLE -->
<script>
const toggleBtn = document.getElementById("theme-toggle");

if (localStorage.getItem("theme") === "dark") {
  document.body.classList.add("dark-mode");
  toggleBtn.textContent = "☀️";
}

toggleBtn.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");

  const isDark = document.body.classList.contains("dark-mode");
  toggleBtn.textContent = isDark ? "☀️" : "🌙";

  localStorage.setItem("theme", isDark ? "dark" : "light");
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

