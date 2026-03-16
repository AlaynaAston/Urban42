<?php
session_start();
require 'db.php';

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["userID"];

// Initialize variables
$total = 0;
$rows = [];
$error = '';

try {
    // Get basket items - using prepared statement
    $sql = "
        SELECT BasketItem.productID, BasketItem.quantity, Product.price, Product.name
        FROM BasketItem
        JOIN Basket ON BasketItem.basketID = Basket.basketID
        JOIN Product ON BasketItem.productID = Product.productID
        WHERE Basket.userID = ?
    ";
    
    $stmt = $db->prepare($sql);
    $stmt->execute([$userID]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculate totals and prepare rows
    foreach($result as $row){
        $row['subtotal'] = $row['price'] * $row['quantity'];
        $total += $row['subtotal'];
        $rows[] = $row;
    }
    
    // Check if basket is empty
    if (empty($rows)) {
        header("Location: basket.php?error=empty");
        exit();
    }
    
} catch(PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}

// If user clicks Purchase
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['purchase']) && !empty($rows)) {
    
    try {
        // Start transaction
        $db->beginTransaction();
        
        // Create order
        $orderSql = "INSERT INTO OrderTable (userID, orderDate, totalAmount) VALUES (?, NOW(), ?)";
        $orderStmt = $db->prepare($orderSql);
        $orderStmt->execute([$userID, $total]);
        $orderID = $db->lastInsertId();
        
        // Insert order items
        $itemSql = "INSERT INTO OrderItem (orderID, productID, quantity, priceAtPurchase) VALUES (?, ?, ?, ?)";
        $itemStmt = $db->prepare($itemSql);
        
        foreach($rows as $r){
            $itemStmt->execute([
                $orderID,
                $r['productID'],
                $r['quantity'],
                $r['price']
            ]);
        }
        
        // Clear basket
        $deleteSql = "DELETE FROM BasketItem WHERE basketID = (SELECT basketID FROM Basket WHERE userID = ?)";
        $deleteStmt = $db->prepare($deleteSql);
        $deleteStmt->execute([$userID]);
        
        // Commit transaction
        $db->commit();
        
        // Redirect to success page
        header("Location: order-confirmation.php?orderID=" . $orderID);
        exit();
        
    } catch(PDOException $e) {
        // Rollback transaction on error
        $db->rollBack();
        $error = "Order failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Urban 42</title>
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>

<!-- Navigation Bar  --> 
<div class="navbar">
    <div class="nav-left">
        <div class="sidebar-icon">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div class="brand-logo">
            <img src="images/urban42.png" alt="Urban 42 Logo">
            <span>Urban 42</span>
        </div>
    </div>
    <div class="nav-right">
        <img src="images/ukflag.jpg" alt="UK Flag" class="flag-icon">
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

<div id="sidebar" class="sidebar">
    <a href="Profile.php">Your Account</a>
    <a href="index.php">Home</a>
    <a href="aboutus.php">About Us</a>
    <a href="shop.php">Shop</a>
    <a href="#">New Arrivals</a>
    <a href="#">Sale</a>
    <a href="ContactPage.php">Contact Us</a>
</div>

<?php if ($error): ?>
    <div class="error-message">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<div class="summary-container">
    <a href="basket.php" class="back-to-basket">← Back to Basket</a>
    
    <h2>Order Summary</h2>

    <?php if (empty($rows)): ?>
        <p class="empty-message">Your basket is empty. <a href="shop.php">Continue shopping</a></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $r): ?>
                <tr>
                    <td class="product-name"><?php echo htmlspecialchars($r['name']); ?></td>
                    <td><?php echo (int)$r['quantity']; ?></td>
                    <td>£<?php echo number_format($r['price'], 2); ?></td>
                    <td>£<?php echo number_format($r['subtotal'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
                
                <tr class="total-row">
                    <td colspan="3" class="total-label"><strong>Total:</strong></td>
                    <td class="total-amount"><strong>£<?php echo number_format($total, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <form method="POST" onsubmit="return confirm('Confirm your purchase?');">
            <input type="hidden" name="purchase" value="1">
            <button class="purchase-button" type="submit">Complete Purchase</button>
        </form>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>