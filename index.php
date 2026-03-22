<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Urban 42 | Home</title>
  
  <link rel="stylesheet" href="indexstyle.css">
  <link rel="stylesheet" href="chatbox.css">

  <script>
    // Show promotional pop-up when the page loads
    window.onload = function () {
      alert("🎉 Welcome to Urban 42! Get 10% off your first purchase when you sign up today!");
    };
  </script>
</head>

<body>
  <!-- Navigation Menu -->
<div class="navbar">

  <div class="nav-left">
    <div class="sidebar-icon" id="menu-toggle">
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
    <span class="currency">GBP £</span>

    <a href="ContactPage.php">Help</a>
    <a href="login.php">Log in</a>

    <button id="theme-toggle" class="theme-toggle">🌙</button>

    <form class="search-form" action="search.php" method="GET">
      <input type="text" placeholder="Search..." name="search" class="nav-search" required>
      <button type="submit">🔍</button>
    </form>

    <a href="basket.php" class="cart-link">Cart</a>

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

  <?php if (isset($_SESSION["userID"]) && $_SESSION["userID"] == 1): ?>
    
    <hr>

    <div class="admin-section">
      <strong style="padding:10px; display:block;">Admin Only</strong>
      <a href="ProductAdd.php">Manage Products</a>
      
    </div>

  <?php endif; ?>
  <br>
  <a href="logout.php">Log Out</a>
</div>

  <hr>
  <hr>

  <!-- Categories Section -->
  <section class="categories-section">
    <h2>Categories</h2>

    <div class="category-card">
      <a href="#">
        <img src="placeholder.jpg" alt="Hoodies">
        <p>Hoodies</p>
      </a>
    </div>

    <div class="category-card">
      <a href="#">
        <img src="placeholder.jpg" alt="Jeans">
        <p>Jeans</p>
      </a>
    </div>

    <div class="category-card">
      <a href="productPage.php">
        <img src="hi top trainer back no bg.png" alt="Shoes">
        <p>Shoes</p>
      </a>
    </div>

    <div class="category-card">
      <a href="#">
        <img src="placeholder.jpg" alt="Hats">
        <p>Hats</p>
      </a>
    </div>
  </section>

  <hr>

  <!-- Trending Items Section -->
  <section class="trending-section">
    <h2>Trending Items</h2>

    <div class="trending-card">
      <img src="placeholder.jpg" alt="Trending Item">
      <p>Urban Hoodie - £45</p>
    </div>

    <div class="trending-card">
      <img src="placeholder.jpg" alt="Trending Item">
      <p>Denim Jacket - £65</p>
    </div>

    <div class="trending-card">
      <img src="placeholder.jpg" alt="Trending Item">
      <p>Leather Boots - £89</p>
    </div>

    <div class="trending-card">
      <img src="placeholder.jpg" alt="Trending Item">
      <p>Graphic Tee - £25</p>
    </div>
  </section>

  <hr>

  <!-- Footer Section -->
  <footer>
    <a href="aboutus.php">About Us</a>
    <p>&copy; 2025 Urban 42 | All Rights Reserved</p>
  </footer>

  <!-- Chatbox -->
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

  <!-- Sidebar Toggle Script -->
  <script>
    document.querySelector(".sidebar-icon").addEventListener("click", function() {
      document.getElementById("sidebar").classList.toggle("open");
    });

    document.addEventListener("click", function(e) {
      const sidebar = document.getElementById("sidebar");
      const icon = document.querySelector(".sidebar-icon");

      if (!sidebar.contains(e.target) && !icon.contains(e.target)) {
        sidebar.classList.remove("open");
      }
    });
  </script>

  <!-- Theme Toggle Script -->
  <script>
document.addEventListener("DOMContentLoaded", function () {

  const toggleBtn = document.getElementById("theme-toggle");

  if (!toggleBtn) return;

  // Load saved theme
  const savedTheme = localStorage.getItem("theme");

  if (savedTheme === "dark") {
    document.body.classList.add("dark-mode");
    toggleBtn.textContent = "☀️";
  } else {
    toggleBtn.textContent = "🌙";
  }

  // Toggle theme
  toggleBtn.addEventListener("click", function () {

    document.body.classList.toggle("dark-mode");

    const isDark = document.body.classList.contains("dark-mode");

    toggleBtn.textContent = isDark ? "☀️" : "🌙";

    localStorage.setItem("theme", isDark ? "dark" : "light");

  });

});
</script>

  <!-- Chatbox Script -->
  <script src="chatbox.js"></script>
</body>
</html>