<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

$conn = new mysqli("localhost","cs2team42","5EUURc7WnOkMUR0kAsEz2L5gp","cs2team42_db");
if ($conn->connect_error) die("DB error");

$userID = 1;

// Get basket items
$sql = "
SELECT BasketItem.productID, BasketItem.quantity, Product.price
FROM BasketItem
JOIN Basket ON BasketItem.basketID = Basket.basketID
JOIN Product ON BasketItem.productID = Product.productID
WHERE Basket.userID = $userID
";
$result = $conn->query($sql);

$total = 0;
$rows = [];
while($row = $result->fetch_assoc()){
    $row['subtotal'] = $row['price'] * $row['quantity'];
    $total += $row['subtotal'];
    $rows[] = $row;
}

// If user clicks Purchase
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Create order
    $conn->query("INSERT INTO OrderTable (userID, orderDate, totalAmount)
                  VALUES ($userID, NOW(), $total)");

    $orderID = $conn->insert_id;

    // Insert order items
    foreach($rows as $r){
        $conn->query("INSERT INTO OrderItem (orderID, productID, quantity, priceAtPurchase)
                      VALUES ($orderID, {$r['productID']}, {$r['quantity']}, {$r['price']})");
    }

    // Clear basket
    $conn->query("DELETE FROM BasketItem 
                  WHERE basketID = (SELECT basketID FROM Basket WHERE userID=$userID)");

    echo "<h2>Order placed successfully!</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout</title>
<link rel="stylesheet" href="checkoutstyle.css">
</head>

<body>

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

<?php foreach($rows as $r){ ?>
<tr>
<td><?php echo $r['productID']; ?></td>
<td><?php echo $r['quantity']; ?></td>
<td>£<?php echo number_format($r['price'],2); ?></td>
<td>£<?php echo number_format($r['subtotal'],2); ?></td>
</tr>
<?php } ?>

<tr class="total-row">
<td colspan="3">Total</td>
<td>£<?php echo number_format($total,2); ?></td>
</tr>

</tbody>
</table>

<form method="POST">
<button class="purchase-button" type="submit">Purchase</button>
</form>

</div>
</body>
</html>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2025 Urban 42 | All Rights Reserved</p>
  </footer>

</body>
</html>