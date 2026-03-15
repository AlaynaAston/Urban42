<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Urban 42 | Streetwear Since 2025</title>
  
  <link rel="stylesheet" href="indexstyle.css">
  <link rel="stylesheet" href="chatbox.css">

  <script>
    // Welcome message for new visitors
    window.onload = function () {
      // Only show once per session
      if (!sessionStorage.getItem('welcomeShown')) {
        alert("👋 Welcome to Urban 42! Sign up today and get 10% off your first order.");
        sessionStorage.setItem('welcomeShown', 'true');
      }
    };
  </script>
</head>

<body>
  <!-- Navigation - clean and functional -->
  <div class="navbar">
    <div class="nav-left">
      <div class="sidebar-icon" aria-label="Menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      
      <div class="brand-logo">
        <img src="urban42.png" alt="Urban 42">
        <span>URBAN 42</span>
      </div>
    </div>
    
    <div class="nav-right">
      <img src="ukflag.jpg" alt="UK" class="flag-icon">
      <span>GBP £</span>
      
      <a href="ContactPage.php">Help</a>
      <a href="login.php">Sign in</a>
      
      <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode">🌙</button>
      
      <form class="search-form" action="search.php" method="GET">
        <input type="text" placeholder="Search products..." name="search" required>
        <button type="submit" aria-label="Search">🔍</button>
      </form>
      
      <a href="basket.php" class="cart-link">
        <span>🛒</span>
        <span>Cart</span>
      </a>
    </div>
  </div>

  <!-- Sidebar menu -->
  <div id="sidebar" class="sidebar">
    <h3>Menu</h3>
    <a href="Profile.php">Your Account</a>
    <a href="index.php">Home</a>
    <a href="aboutus.php">About Us</a>
    <a href="shop.php">Shop All</a>
    <a href="new-arrivals.php">New Arrivals</a>
    <a href="sale.php">Sale</a>
    <a href="ContactPage.php">Contact</a>
  </div>

  <!-- Hero section - simple welcoming banner -->
  <div class="hero-banner">
    <div class="hero-content">
      <h1>Fresh drops,<br>urban spirit</h1>
      <p>Streetwear that speaks your language. New collection out now.</p>
      <a href="shop.php" class="hero-btn">Shop Now →</a>
    </div>
  </div>

  <!-- Categories section -->
  <section class="categories-section">
    <h2>Shop by Category</h2>
    
    <div class="category-grid">
      <a href="hoodies.php" class="category-card">
        <div class="card-image" style="background: #e0e0e0;">
          <span class="category-icon">🧥</span>
        </div>
        <h3>Hoodies</h3>
        <p>From £45</p>
      </a>

      <a href="jeans.php" class="category-card">
        <div class="card-image" style="background: #e0e0e0;">
          <span class="category-icon">👖</span>
        </div>
        <h3>Jeans</h3>
        <p>From £55</p>
      </a>

      <a href="productPage.php" class="category-card">
        <div class="card-image">
          <img src="hi top trainer back no bg.png" alt="Trainers">
        </div>
        <h3>Shoes</h3>
        <p>From £65</p>
      </a>

      <a href="accessories.php" class="category-card">
        <div class="card-image" style="background: #e0e0e0;">
          <span class="category-icon">🧢</span>
        </div>
        <h3>Hats</h3>
        <p>From £25</p>
      </a>
    </div>
  </section>

  <!-- Featured products -->
  <section class="featured-section">
    <h2>Trending Now</h2>
    
    <div class="product-grid">
      <div class="product-card">
        <div class="product-image" style="background: #e0e0e0;"></div>
        <div class="product-info">
          <h3>Oversized Hoodie</h3>
          <p class="price">£45</p>
          <button class="quick-add">Quick Add</button>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image" style="background: #e0e0e0;"></div>
        <div class="product-info">
          <h3>Cargo Pants</h3>
          <p class="price">£55</p>
          <button class="quick-add">Quick Add</button>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image" style="background: #e0e0e0;"></div>
        <div class="product-info">
          <h3>Graphic Tee</h3>
          <p class="price">£28</p>
          <button class="quick-add">Quick Add</button>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image" style="background: #e0e0e0;"></div>
        <div class="product-info">
          <h3>Windbreaker</h3>
          <p class="price">£75</p>
          <button class="quick-add">Quick Add</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Simple newsletter signup -->
  <section class="newsletter">
    <div class="newsletter-content">
      <h2>Stay in the loop</h2>
      <p>Get early access to new drops and exclusive offers.</p>
      <form class="newsletter-form">
        <input type="email" placeholder="Your email address" required>
        <button type="submit">Subscribe</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-links">
      <a href="aboutus.php">About</a>
      <a href="ContactPage.php">Contact</a>
      <a href="returns.php">Returns</a>
      <a href="faq.php">FAQ</a>
      <a href="privacy.php">Privacy</a>
    </div>
    <p class="copyright">© 2026 Urban 42. All rights reserved.</p>
  </footer>

  <!-- Chat widget -->
  <div class="u42-chat-system">
    <div class="u42-chat-toggle" onclick="toggleChat()" aria-label="Open chat">💬</div>

    <div class="u42-chatbox" id="chatbox">
      <div class="u42-chat-header">
        <span>Support</span>
        <span onclick="toggleChat()" style="cursor:pointer;">✕</span>
      </div>
      <div class="u42-chat-messages" id="chatMessages"></div>
      <div class="u42-chat-input-area">
        <input type="text" id="chatInput" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
      </div>
    </div>
  </div>

  <!-- Simple scripts -->
  <script>
    // Sidebar toggle
    document.querySelector(".sidebar-icon")?.addEventListener("click", function() {
      document.getElementById("sidebar").classList.toggle("open");
    });

    // Close sidebar when clicking outside
    document.addEventListener("click", function(e) {
      const sidebar = document.getElementById("sidebar");
      const icon = document.querySelector(".sidebar-icon");
      
      if (sidebar && icon && !sidebar.contains(e.target) && !icon.contains(e.target)) {
        sidebar.classList.remove("open");
      }
    });

    // Dark mode toggle
    const themeBtn = document.getElementById("theme-toggle");
    
    if (localStorage.getItem("theme") === "dark") {
      document.body.classList.add("dark-mode");
      themeBtn.textContent = "☀️";
    }

    themeBtn?.addEventListener("click", function() {
      document.body.classList.toggle("dark-mode");
      
      if (document.body.classList.contains("dark-mode")) {
        themeBtn.textContent = "☀️";
        localStorage.setItem("theme", "dark");
      } else {
        themeBtn.textContent = "🌙";
        localStorage.setItem("theme", "light");
      }
    });
  </script>

  <script src="chatbox.js"></script>
</body>
</html>