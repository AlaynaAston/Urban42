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

<?php
$total = 0;

if (empty($items)) {
    echo "<div class='container'><p>Your basket is empty</p></div>";
} else {
?>
<div class="container">
    <?php foreach ($items as $row): 
        $itemTotal = $row['price'] * $row['quantity'];
        $total += $itemTotal;
    ?>
    <div class="basket-item">
        <span>
            <?php echo htmlspecialchars($row['name']); ?>
            <span class="price">£<?php echo number_format($row['price'],2); ?></span>
        </span>
        <input class="qty" type="number" min="0" value="<?php echo $row['quantity']; ?>">
    </div>
    <?php endforeach; ?>

    <div class="total-box">
        Total: £<span id="total"><?php echo number_format($total,2); ?></span>
    </div>

    <button><a href="checkout.php">Checkout</a></button>
</div>
<?php } ?>

  <div class="total-box">
    Total: £<span id="total"><?php echo number_format($total,2); ?></span>
  </div>

  <button><a href="checkout.php">Checkout</a></button>
</div>

</body>
</html>