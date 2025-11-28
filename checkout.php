<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Urban 42 | Checkout</title>
  <link rel="stylesheet" href="checkoutstyle.css">
</head>

<body>

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
      <a href="#">Help</a>
      <a href="#">Log in</a>

      <form class="search-form">
        <input type="text" placeholder="Search..." name="search">
        <button type="submit">🔍</button>
      </form>

      <a href="#">Cart</a>
    </div>
  </div>

  <!-- Order Summary -->
  <h2>Order Summary</h2>
  
<form action="checkoutprocess.php" method="POST">

    <label>Order ID</label>
    <input type="number" name="orderID" required>

    <label>Product ID</label>
    <input type="number" name="productID" required>

    <label>Quantity</label>
    <input type="number" name="quantity" required>

    <label>Item Price</label>
    <input type="number" step="0.01" name="itemPrice" required>

    <button type="submit">Add Purchase</button>
</form>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2025 Urban 42 | All Rights Reserved</p>
  </footer>

</body>
</html>