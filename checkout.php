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
      <a href="ContactPage">Help</a>
      <a href="login.html">Log in</a>

      <form class="search-form">
        <input type="text" placeholder="Search..." name="search">
        <button type="submit">🔍</button>
      </form>

      <a href="basket.html">Cart</a>

      
    </div>
  </div>

  <!-- Order Summary -->
<div class="summary-container">
    <h2>Order Summary</h2>

    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            <!-- Example row — these would be replaced dynamically with PHP -->
            <tr>
                <td>101</td>
                <td>2</td>
                <td>$15.00</td>
                <td>$30.00</td>
            </tr>

            <tr>
                <td>205</td>
                <td>1</td>
                <td>$40.00</td>
                <td>$40.00</td>
            </tr>

            <tr class="total-row">
                <td colspan="3">Total</td>
                <td>$70.00</td>
            </tr>
        </tbody>
    </table>

    <form action="add_purchase.php" method="POST">
        <button class="purchase-button" type="submit">Purchase</button>
    </form>
</div>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2025 Urban 42 | All Rights Reserved</p>
  </footer>

</body>
</html>