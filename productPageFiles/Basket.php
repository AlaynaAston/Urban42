<?php
session_start();
require 'testdb.php';

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["userID"];

// Handle delete request
if (isset($_POST['delete_item'])) {
    $productID = $_POST['product_id'];
    
    // First get the basket ID for this user
    $basketStmt = $db->prepare("SELECT basketID FROM Basket WHERE userID = ?");
    $basketStmt->execute([$userID]);
    $basket = $basketStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($basket) {
        $deleteStmt = $db->prepare("DELETE FROM BasketItem WHERE basketID = ? AND productID = ?");
        $deleteStmt->execute([$basket['basketID'], $productID]);
    }
    
    // Redirect to refresh the page
    header("Location: basket.php");
    exit();
}

// Handle quantity update
if (isset($_POST['update_quantity'])) {
    $productID = $_POST['product_id'];
    $newQuantity = $_POST['quantity'];
    
    // Get basket ID
    $basketStmt = $db->prepare("SELECT basketID FROM Basket WHERE userID = ?");
    $basketStmt->execute([$userID]);
    $basket = $basketStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($basket && $newQuantity > 0) {
        $updateStmt = $db->prepare("UPDATE BasketItem SET quantity = ? WHERE basketID = ? AND productID = ?");
        $updateStmt->execute([$newQuantity, $basket['basketID'], $productID]);
    }
    
    // Redirect to refresh the page
    header("Location: basket.php");
    exit();
}

$stmt = $db->prepare("
SELECT Product.productID, Product.name, Product.price, BasketItem.quantity
FROM Basket
JOIN BasketItem ON Basket.basketID = BasketItem.basketID
JOIN Product ON BasketItem.productID = Product.productID
WHERE Basket.userID = ?
");

$stmt->execute([$userID]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Basket — Urban 42</title>
    <link rel="stylesheet" href="rahmanstyle.css">
    <link href="navbarstyling.css" rel="stylesheet">
</head>

<body>

<!-- Your navbar code here -->
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
<a href="<?php if(isset($_SESSION['userID']))
    {echo("logout.php");} else{echo("login.php");}?>"><?php if(isset($_SESSION['userID'])){echo("Log Out");} else{echo("Log In");}?></a>

<button id="theme-toggle" class="theme-toggle">🌙</button>

<form class="search-form" action="search.php" method="GET">
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
        <a href="Productlist.php">Shop</a>
        <a href="#">New Arrivals</a>
        <a href="#">Sale</a>
        <a href="ContactPage.php">Contact Us</a>
    </div><!--end of the navigation bar-->
<div class="container">
    <h1>Your Basket</h1>

    <?php if (!$items): ?>
        <div class="empty-basket">
            <p>Your basket is empty.</p>
            <a href="shop.php" class="continue-shopping">Continue Shopping</a>
        </div>
    <?php else: ?>
        
        <div class="basket-header">
            <span>Product</span>
            <span style="margin-right: 250px;">Quantity</span>
            <span>Item Total</span>
        </div>

        <?php
        $total = 0;
        foreach ($items as $row):
            $itemTotal = $row['price'] * $row['quantity'];
            $total += $itemTotal;
        ?>

        <div class="basket-item">
            <div class="item-info">
                <span class="item-name"><?= htmlspecialchars($row['name']); ?></span>
                <span class="item-price">£<?= number_format($row['price'], 2); ?> each</span>
            </div>
            
            <div class="item-controls">
                <!-- Update quantity form -->
                <form method="POST" class="quantity-control">
                    <input type="hidden" name="product_id" value="<?= $row['productID']; ?>">
                    <input type="number" name="quantity" value="<?= $row['quantity']; ?>" 
                           min="1" max="99" class="quantity-input" 
                           onchange="this.form.submit()">
                    <input type="hidden" name="update_quantity" value="1">
                </form>
                
                <!-- Delete form -->
                <form method="POST" onsubmit="return confirm('Remove this item from your basket?');">
                    <input type="hidden" name="product_id" value="<?= $row['productID']; ?>">
                    <button type="submit" name="delete_item" class="delete-btn">Delete</button>
                </form>
                
                <span class="item-total">£<?= number_format($itemTotal, 2); ?></span>
            </div>
        </div>

        <?php endforeach; ?>

        <div class="total-box clearfix">
            <span>Total: £<?= number_format($total, 2); ?></span>
        </div>

        <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
    <?php endif; ?>
</div>

<script>
// Add confirmation for quantity changes to zero
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        if (this.value === '0') {
            if (!confirm('Setting quantity to 0 will remove the item. Continue?')) {
                this.value = '1';
                return false;
            }
        }
        // Auto-submit the form when quantity changes
        this.form.submit();
    });
});
</script>

</body>
</html>