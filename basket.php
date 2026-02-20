<?php
$conn = new mysqli("localhost", "root", "", "cs2team42_db");

$userID = 1; 

$sql = "SELECT Product.name, Product.price, BasketItem.quantity
        FROM BasketItem
        JOIN Product ON BasketItem.productID = Product.productID
        WHERE BasketItem.userID = $userID";

$result = $conn->query($sql);

$items = [];

while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode($items);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Your Basket — Urban 42</title>
  <link rel="stylesheet" href="rahmanstyle.css">
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
    <img src="ukflag.jpg" class="flag-icon">
    <span>GBP £</span>
    <a href="contact.html">Help</a>
    <a href="login.html">Log in</a>

    <form class="search-form">
      <input type="text" placeholder="Search..." name="search">
      <button type="submit">🔍</button>
    </form>

    <a href="basket.php">Cart</a>
  </div>
</div>

<div class="container">
  <h1>Your Basket</h1>

  <?php
  $total = 0;

  while ($row = $result->fetch_assoc()) {
      $itemTotal = $row['price'] * $row['quantity'];
      $total += $itemTotal;
  ?>
    <div class="basket-item">
      <span>
        <?php echo $row['name']; ?>
        <span class="price">£<?php echo number_format($row['price'],2); ?></span>
      </span>
      <input class="qty" type="number" min="0" value="<?php echo $row['quantity']; ?>">
    </div>
  <?php } ?>

  <div class="total-box">
    Total: £<span id="total"><?php echo number_format($total,2); ?></span>
  </div>

  <button><a href="checkout.php">Checkout</a></button>
</div>

</body>
</html>