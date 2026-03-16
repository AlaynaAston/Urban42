<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["user_id"];

$stmt = $db->prepare("
SELECT Product.name, Product.price, BasketItem.quantity
FROM BasketItem
JOIN Product ON BasketItem.productID = Product.productID
WHERE BasketItem.userID = ?
");

$stmt->execute([$userID]);

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Your Basket — Urban 42</title>
  <link rel="stylesheet" href="rahmanstyle.css">
</head>

<body>

<!-- NAVBAR -->
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

        <a href="ContactPage.php">Help</a>
        <a href="login.php">Log in</a>

        <button id="theme-toggle" class="theme-toggle">🌙</button>

        <form class="search-form">
            <input type="text" placeholder="Search..." name="search" class="nav-search">
            <button type="submit">🔍</button>
        </form>

        <a href="basket.php">Cart</a>
    </div>

</div>

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
    <a href="Profile.php">Your Account</a>
    <a href="index.php">Home</a>
    <a href="aboutus.php">About Us</a>
    <a href="index.php">Shop</a>
    <a href="#">New Arrivals</a>
    <a href="#">Sale</a>
    <a href="ContactPage.php">Contact Us</a>
</div>

<!-- BASKET CONTENT -->
<div class="basket-container">

<h2>Your Basket</h2>

<?php
$total = 0;

if (count($items) > 0) {

    foreach ($items as $row) {

        $itemTotal = $row['price'] * $row['quantity'];
        $total += $itemTotal;
?>

<div class="basket-item">

    <span class="product-name">
        <?php echo htmlspecialchars($row['name']); ?>
    </span>

    <span class="price">
        £<?php echo number_format($row['price'], 2); ?>
    </span>

    <input class="qty"
           type="number"
           min="0"
           value="<?php echo $row['quantity']; ?>">

</div>

<?php
    }

} else {
    echo "<p>Your basket is empty.</p>";
}
?>

<div class="total-box">
    Total: £<span id="total"><?php echo number_format($total, 2); ?></span>
</div>

<a href="checkout.php" class="checkout-btn">Checkout</a>

</div>

</body>
</html>