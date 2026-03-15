<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="indexstyle.css">

<!-- added: chatbox css -->
<link rel="stylesheet" href="chatbox.css">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Urban 42 | Home</title>

  <script>
    // Show promotional pop-up when the page loads
    window.onload = function () {
      alert("🎉 Welcome to Urban 42! Get 10% off your first purchase when you sign up today!");
    };
  </script>

</head>

<body>

  <!-- Navigation Menu -->
  <!-- If you guys could link your pages where the "#" is -->
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
        <form class="search-form" action="search.php" method="GET">
  <input type="text" placeholder="Search..." name="search" class="nav-search" required>
  <button type="submit">🔍</button>
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
    
  </body>

  <hr>
  <hr>

  <!-- Categories Section -->
  <!-- If you guys could link your pages where the "#" is -->

  <section>
    <h2>Categories</h2>

    <div>
      <a href="#">
        <img src="">
        <p>Hoodies</p>
      </a>
    </div>

    <div>
      <a href="#">
        <img src="">
        <p>Jeans</p>
      </a>
    </div>

    <div>
      <a href="productPage.php">
        <img src="hi top trainer back no bg.png">
        <p>Shoes</p>
      </a>
    </div>

    <div>
      <a href="#">
        <img src="">
        <p>Hats</p>
      </a>
    </div>
  </section>

  <hr>

  <!-- Products Section -->
  <section>
    <h2>Trending Items</h2>

    <div>
      <img src="">
      <p></p>
    </div>

    <div>
      <img src="">
      <p></p>
    </div>

    <div>
      <img src="">
      <p></p>
    </div>

    <div>
      <img src="">
      <p></p>
    </div>
  </section>

  <hr>

  <!-- Footer Section -->
  <footer>
    <a href="aboutus.php">About Us</a>
    <p>&copy; 2025 Urban 42 | All Rights Reserved</p>
  </footer>


  <!-- ========================================= -->
  <!-- added: chatbox html -->
  <!-- ========================================= -->
  <div class="u42-chat-system">

    <!-- added: floating chat button -->
    <div class="u42-chat-toggle" onclick="toggleChat()">💬</div>

    <!-- added: chatbox panel -->
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

  <!-- added: chatbox script -->
  <script src="chatbox.js"></script>

</body>

</html>