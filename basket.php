<?php
session_start();
require 'db.php';

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["userID"];

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

<div class="container">

<h1>Your Basket</h1>

<?php
$total = 0;

if (!$items) {
    echo "<p>Your basket is empty.</p>";
}

foreach ($items as $row) {

$itemTotal = $row['price'] * $row['quantity'];
$total += $itemTotal;
?>

<div class="basket-item">

<span>
<?= htmlspecialchars($row['name']); ?>
<span class="price">£<?= number_format($row['price'],2); ?></span>
</span>

<input class="qty" type="number" min="1" value="<?= $row['quantity']; ?>">

</div>

<?php } ?>

<div class="total-box">
Total: £<span id="total"><?= number_format($total,2); ?></span>
</div>

<a href="checkout.php" class="checkout-btn">Checkout</a>

</div>

</body>
</html>