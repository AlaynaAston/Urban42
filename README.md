
<!DOCTYPE html>
<html>
<head>
  <title>Your Basket</title>
  <link rel="stylesheet" href="styles.css">
  <script defer src="basket.js"></script>
</head>
<body>

<div class="navbar">
  <a href="index.html">Login</a>
  <a href="signup.html">Sign Up</a>
</div>

<div class="container">
  <h1>Your Basket</h1>

  <div class="basket-item">
    <span>Urban Hoodie <span class="price" data-price="29.99">$29.99</span></span>
    <input class="qty" type="number" min="0" value="0">
  </div>

  <div class="basket-item">
    <span>Graphic Tee <span class="price" data-price="19.99">$19.99</span></span>
    <input class="qty" type="number" min="0" value="0">
  </div>

  <div class="basket-item">
    <span>Joggers <span class="price" data-price="24.99">$24.99</span></span>
    <input class="qty" type="number" min="0" value="0">
  </div>

  <div class="total-box">
    Total: $<span id="total">0.00</span>
  </div>

  <button>Checkout</button>
</div>

</body>
</html>

