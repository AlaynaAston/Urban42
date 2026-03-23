<?php 
require 'testdb.php';
session_start();
if(!isset($_SESSION["userID"])) {
            header("Location: login.php");
            exit();
        }

   $userID = $_SESSION["userID"];

$sql = "
SELECT orders.*, orderitem.productID, orderitem.quantity, product.name, product.image1Path
FROM orders
INNER JOIN orderitem ON orderitem.orderID = orders.orderID
INNER JOIN product ON orderitem.productID = product.productID
WHERE orders.userID = ?
";

$stmt = $db->prepare($sql);
$stmt->execute([$userID]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$orders = [];

foreach ($result as $row) {

    $orderID = $row['orderID'];

    if (!isset($orders[$orderID])) {
        $orders[$orderID] = [
            'orderDate' => $row['orderDate'],
            'status' => $row['status'],
            'total' => $row['totalAmount'],
            'items' => []
        ];
    }

    $orders[$orderID]['items'][] = [
        'productID' => $row['productID'],
        'name' => $row['name'],
        'image' => $row['image1Path'],
        'quantity' => $row['quantity']
    ];
}
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="navbarstyling.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link href="OrdersStyles.css" rel="stylesheet">
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

    <h1>Your Orders</h1>
    <?php if(empty($orders)): ?>
    <p>You have no orders yet.</p>
<?php endif; ?>

    <?php foreach($orders as $orderID => $order): ?>
    
    <div id="order-card">
        <div id="order-headings">
            <p id="date"><?php echo htmlspecialchars($order['orderDate']); ?></p>
            <p id="orderID">OrderID: <?php echo htmlspecialchars($orderID); ?></p>
            <p id="orderTotal">Total: £<?php echo number_format($order['total'],2);?> </p>
        </div>
        <?php foreach($order['items'] as $item): ?>
        <div id="order-content">
            <img src="<?php echo htmlspecialchars($item['image']); ?>" id="product-image">
            <div>
            <p id="product-name"><?php echo htmlspecialchars($item['name']); ?></p>
            <p id="product-quantity">Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
        </div>
        </div>
        <a href="productPage.php?id=<?php echo htmlspecialchars($item['productID']);?>"><button type="button" id="redirectButton">Buy Again</button></a>
         <?php endforeach; ?>
</div>
<?php endforeach; ?>

</body>
</html>