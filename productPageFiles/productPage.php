<?php 
include('testdb.php');
session_start();

/* Check product ID exists */
if (!isset($_GET['id'])) {
    header("Location: 404PageError.php");
    exit();
}

$pid = $_GET['id'];

/* Get product details */
$sql = $db->prepare("
SELECT *
FROM products
WHERE productID = :pid
");

$sql->execute([':pid' => $pid]);
$productDetails = $sql->fetch(PDO::FETCH_ASSOC);

if (!$productDetails) {
    header("Location: 404PageError.php");
    exit();
}

/* Temporary session until login system finished */
if (!isset($_SESSION["userID"])) {
    $_SESSION["userID"] = 1;
}

/* Add to basket */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submitted'])) {

    $user_id = $_SESSION['userID'];
    $productID = $_POST['productID'] ?? null;
    $productSize = $_POST['sizes'] ?? null;
    $productQuantity = $_POST['quantity'] ?? 1;

    if ($productID && $productSize && $productQuantity > 0) {

        $stmt = $db->prepare("
        INSERT INTO baskets (userID, productID, quantity, size)
        VALUES (?, ?, ?, ?)
        ");

        $stmt->execute([$user_id, $productID, $productQuantity, $productSize]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= htmlspecialchars($productDetails['name']); ?> | Urban 42</title>

<link href="styles.css" rel="stylesheet">
<link href="navbarstyling.css" rel="stylesheet">

<script src="scripts.js" defer></script>
<script src="ajax.js" defer></script>

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
<a href="index.php">Shop</a>
<a href="#">New Arrivals</a>
<a href="#">Sale</a>
<a href="ContactPage.php">Contact Us</a>

</div>

<!-- PRODUCT DETAILS -->

<div id="product-details">

<div class="carousel" data-carousel aria-label="Product Photos">

<button class="carousel-button prev" data-carousel-button="prev">&#60;</button>
<button class="carousel-button next" data-carousel-button="next">&#62;</button>

<ul data-slides>

<li class="slide">
<img src="<?= htmlspecialchars($productDetails['image1Path']); ?>">
</li>

<li class="slide" data-active>
<img src="<?= htmlspecialchars($productDetails['image2Path']); ?>">
</li>

<li class="slide">
<img src="<?= htmlspecialchars($productDetails['image3Path']); ?>">
</li>

</ul>

</div>


<div id="product-text">

<div id="product-title">
<p><?= htmlspecialchars($productDetails['name']); ?></p>
</div>

<div id="price">
<p>£<?= htmlspecialchars($productDetails['price']); ?></p>
</div>

<div id="stockCount">
<p>In Stock</p>
</div>

<div id="short-description">
<p><?= htmlspecialchars($productDetails['description']); ?></p>
</div>


<form method="POST" action="">

<input type="hidden" name="submitted" value="1">

<div id="inputSize">

<label>Size:</label><br>

<select name="sizes" class="sizes" required>

<option value="" disabled selected>Select size</option>
<option value="XS">Extra Small</option>
<option value="S">Small</option>
<option value="M">Medium</option>
<option value="L">Large</option>
<option value="XL">Extra Large</option>
<option value="XXL">XX-Large</option>

</select>

</div>


<div id="inputQuantity">

<label>Quantity:</label><br>
<input type="number" value="1" name="quantity" min="1">

</div>


<input type="hidden" name="productID" value="<?= htmlspecialchars($productDetails['productID']); ?>">


<div class="checkout">
<input type="submit" value="Add to Basket">
</div>

</form>

</div>

</div>


<div id="extra-details">

<p id="materials">More Information</p>

<div id="full-description" hidden>

<p><?= htmlspecialchars($productDetails['material']); ?></p>
<p>Product code: <?= htmlspecialchars($productDetails['productID']); ?></p>

</div>


<p id="returns">Return Policy</p>

<div id="return-policy" hidden>

<p id="policy-text">

We are happy to refund or exchange any item within 28 days of purchase,
provided the item is returned in a saleable condition with an original receipt.
View full details of our Returns Policy.

</p>

</div>

</div>

</body>
</html>