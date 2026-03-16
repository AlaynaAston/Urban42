<?php
session_start();
require 'db.php';

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["userID"];

$stmt = $db->prepare("
SELECT 
Product.productID,
Product.name,
Product.price,
Product.image1Path,
BasketItem.quantity
FROM Basket
JOIN BasketItem ON Basket.basketID = BasketItem.basketID
JOIN Product ON BasketItem.productID = Product.productID
WHERE Basket.userID = ?
");

$stmt->execute([$userID]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Your Basket</title>

<style>

body{
font-family: Arial;
background:#f3f3f3;
margin:0;
}

.container{
width:90%;
margin:auto;
display:flex;
gap:30px;
margin-top:40px;
}

.basket{
flex:3;
background:white;
padding:20px;
border-radius:8px;
}

.summary{
flex:1;
background:white;
padding:20px;
border-radius:8px;
height:fit-content;
}

.basket-item{
display:flex;
gap:20px;
padding:20px 0;
border-bottom:1px solid #ddd;
align-items:center;
}

.product-img{
width:120px;
}

.product-img img{
width:100%;
border-radius:6px;
}

.product-info{
flex:2;
}

.product-name{
font-size:18px;
font-weight:bold;
}

.price{
color:#B12704;
font-weight:bold;
margin-top:5px;
}

.qty{
width:60px;
padding:5px;
}

.remove-btn{
color:#007185;
cursor:pointer;
font-size:14px;
}

.remove-btn:hover{
text-decoration:underline;
}

.summary h2{
margin-top:0;
}

.checkout-btn{
background:#FFD814;
border:none;
padding:12px;
width:100%;
font-size:16px;
border-radius:6px;
cursor:pointer;
}

.checkout-btn:hover{
background:#F7CA00;
}

.total{
font-size:20px;
margin:20px 0;
}

</style>
</head>

<body>

<div class="container">

<div class="basket">

<h1>Your Shopping Basket</h1>

<?php
$total = 0;

if (!$items){
echo "<p>Your basket is empty.</p>";
}

foreach($items as $item){

$subtotal = $item['price'] * $item['quantity'];
$total += $subtotal;
?>

<div class="basket-item">

<div class="product-img">
<img src="<?= htmlspecialchars($item['image1Path']) ?>">
</div>

<div class="product-info">

<div class="product-name">
<?= htmlspecialchars($item['name']) ?>
</div>

<div class="price">
£<?= number_format($item['price'],2) ?>
</div>

<label>Qty:</label>
<input class="qty" type="number" value="<?= $item['quantity'] ?>" min="1">

<br><br>

<span class="remove-btn">Delete</span>

</div>

<div>

<strong>
£<?= number_format($subtotal,2) ?>
</strong>

</div>

</div>

<?php } ?>

</div>

<div class="summary">

<h2>Order Summary</h2>

<div class="total">
Subtotal: £<?= number_format($total,2) ?>
</div>

<button class="checkout-btn" onclick="location.href='checkout.php'">
Proceed to Checkout
</button>

</div>

</div>

</body>
</html>