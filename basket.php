<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
  <style>
    /* Additional styles for empty basket */
    .empty-basket {
      text-align: center;
      padding: 50px 20px;
      background: #f9f9f9;
      border-radius: 8px;
      margin: 20px 0;
    }
    
    .empty-basket p {
      font-size: 18px;
      color: #666;
      margin-bottom: 20px;
    }
    
    .continue-shopping {
      display: inline-block;
      background-color: #333;
      color: white;
      padding: 12px 30px;
      text-decoration: none;
      border-radius: 4px;
      transition: background-color 0.3s;
    }
    
    .continue-shopping:hover {
      background-color: #555;
    }
    
    button a {
      color: white;
      text-decoration: none;
    }
    
    button {
      background-color: #333;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }
    
    button:hover {
      background-color: #555;
    }
    
    button:disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }
  </style>
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

<div class="container">
    <?php if (empty($items)): ?>
        <!-- Empty basket message -->
        <div class="empty-basket">
            <h2>Your basket is empty</h2>
            <p>Looks like you haven't added anything to your basket yet.</p>
            <a href="index.php" class="continue-shopping">Continue Shopping</a>
        </div>
    <?php else: ?>
        <!-- Display basket items -->
        <?php 
        $total = 0;
        foreach ($items as $row): 
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

        <button>
            <a href="checkout.php">Checkout</a>
        </button>
    <?php endif; ?>
</div>

<script>
    // JavaScript to handle quantity updates
    document.querySelectorAll('.qty').forEach(input => {
        input.addEventListener('change', function() {
            if (this.value === '0') {
                if (confirm('Remove this item from basket?')) {
                    
                    this.closest('.basket-item').remove();
                    
                    // Recalculate total
                    let total = 0;
                    document.querySelectorAll('.basket-item').forEach(item => {
                        const priceText = item.querySelector('.price').textContent;
                        const price = parseFloat(priceText.replace('£', ''));
                        const qty = parseInt(item.querySelector('.qty').value);
                        total += price * qty;
                    });
                    
                    document.getElementById('total').textContent = total.toFixed(2);
                    
                    // If basket becomes empty, reload to show empty state
                    if (document.querySelectorAll('.basket-item').length === 0) {
                        location.reload();
                    }
                } else {
                    this.value = 1; // Reset to 1 if user cancels
                }
            }
        });
    });
</script>

</body>
</html>