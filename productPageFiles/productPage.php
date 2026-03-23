<?php 
include('testdb.php');
session_start();

/* Check product ID exists */
if (!isset($_GET['id'])) {
    header("Location: 404PageError.php");
    exit();
}

    $pid = (int)$_GET['id'];
    $sql = $db->prepare("
    SELECT Product.*
    FROM Product
    WHERE Product.productID = :pid");
    $sql->execute([':pid'=>$pid]);
    
    $productDetails = $sql->fetch(PDO::FETCH_ASSOC);
    if(!$productDetails){
        header("Location: 404PageError.php"); 
        exit();
    }

    //this basically generates random products to suggest the user to buy

    $rsql = $db->prepare("SELECT COUNT(*)
    FROM product");
    $rsql->execute();
    $numProducts = $rsql->fetchColumn();
    
    $productID1 = rand(1, $numProducts);
   while ($productID1 == $pid){
    $productID1 = rand(4, $numProducts);
   }

   $ksql  = $db->prepare("
    SELECT product.*
    FROM product
    WHERE product.productID = :pid");
    $ksql->execute([':pid'=>$productID1]);
    $product1Details = $ksql->fetch(PDO::FETCH_ASSOC);

   
    $productID2 = rand(4, $numProducts);
    while ($productID2 == $productID1 || $productID2 == $pid){
        $productID2 = rand(4, $numProducts);
    }
    
    $ksql2  = $db->prepare("
    SELECT product.*
    FROM product
    WHERE product.productID = :pid");
    $ksql2->execute([':pid'=>$productID2]);
    $product2Details = $ksql2->fetch(PDO::FETCH_ASSOC);

    $productID3 = rand(4, $numProducts);
    while ($productID3 == $productID1 || $productID3 == $productID2 || $productID3 == $pid) {
        $productID3 = rand(4, $numProducts);
    }

    $ksql3  = $db->prepare("
    SELECT product.*
    FROM product
    WHERE product.productID = :pid");
    $ksql3->execute([':pid'=>$productID3]);
    $product3Details = $ksql3->fetch(PDO::FETCH_ASSOC);



   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitted']) ) { 
        if(!isset($_SESSION["userID"])) {
            header("Location: login.php");
            exit();
        }
        $user_id = $_SESSION['userID'];
        $productID = $_POST['productID'];
        $productSize = $_POST['sizes'];
        $productQuantity = $_POST['quantity'];
        
        if ($_POST["action"] === "Add to Basket") {
            $sql = $db->prepare("
    SELECT basket.*
    FROM basket
    WHERE basket.userID = :uid");
    $sql->execute([':uid'=>$user_id]);
$basketDetails = $sql->fetch(PDO::FETCH_ASSOC);
if(!$basketDetails){
   $stmt = $db->prepare("INSERT INTO basket (userID) VALUES (?)");
   $stmt->execute([$user_id]);
   $basketID = $db->lastInsertId();
} 
   else{
    $basketID = $basketDetails['basketID'];
}
   $sql2 = $db->prepare("INSERT INTO basketitem (basketID, productID, quantity) VALUES (?, ?, ?)");
   $sql2->execute([$basketID, $productID, $productQuantity]);

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
    
    <div id="product-details">
        <div class="carousel" data-carousel aria-label="Product Photos">
            <button class="carousel-button prev" data-carousel-button="prev">&#60;</button>
            <button class="carousel-button next" data-carousel-button="next">&#62;</button>
            <ul data-slides>
                <li class="slide">
                    <img src="<?php echo nl2br(htmlspecialchars($productDetails['image1Path']));?>" id="carousel img">
                </li>
                <li class="slide" data-active>
                    <img src="<?php echo nl2br(htmlspecialchars($productDetails['image2Path']));?>">
                </li>
                <li class="slide">
                    <img src="<?php echo nl2br(htmlspecialchars($productDetails['image3Path']));?>">
                </li>
            </ul>
        </div>
        <div id="descriptionAndButtons">
        <div id="product-text">
            <div id="product-title">
                <p><?php echo nl2br(htmlspecialchars($productDetails['name'])); ?></p>
            </div>
            <div id="priceDiv">
                <p id="price">£<?php echo nl2br(htmlspecialchars($productDetails['price']));?></p>
            </div>
            <div id="stockCount">
                <p>In Stock</p>
            </div>
            <div id="short-description">
                <p><?php echo nl2br(htmlspecialchars($productDetails['description']));?></p>
            </div>
            <form method="POST">
                <input type="hidden" name="submitted" value="1">
                <div id="inputSize">
                    <label>Size: </label><br>
                    <select name="sizes" class="sizes" required>
                        <option value="" disabled selected>Select size: </option>
                        <option value="XS">Extra Small</option>
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                        <option value="XL">Extra Large</option>
                        <option value="XXL">XX-Large</option>
                    </select>
                </div>
                <div id="inputQuantity">
                    <label>Quantity: </label><br>
                    <input type="number" value="1" name="quantity" min="1" max="30" id="quantity">
                </div>
                <input hidden value="<?php echo nl2br(htmlspecialchars($productDetails['productID']));?>" name="productID">
                <div class="checkout"><input type="submit" value="Add to Basket" name="action" id="basketButton"></div>
                <!--<div class="checkout"><input type="submit" value="Buy Now" name="action" id="buyButton"></div>-->

            </form>
        </div>
    </div>
    
    <div id="recommendedProducts">
        <div id="recommendedProductsImages">
        <h2>You Might Also Like:</h2>
        <a href="productPage.php?id=<?php echo nl2br (htmlspecialchars($product1Details['productID']));?>"> <img src="<?php echo nl2br(htmlspecialchars($product1Details['image1Path']));?>"class="recommendedProduct"></a>
        <u><p><?php echo nl2br (htmlspecialchars($product1Details['name']));?></p></u>
<a href="productPage.php?id=<?php echo nl2br (htmlspecialchars($product2Details['productID']));?>"><img src="<?php echo nl2br(htmlspecialchars($product2Details['image1Path']));?>"class="recommendedProduct"></a>
    <u><p><?php echo nl2br (htmlspecialchars($product2Details['name']));?></p><br></u>
<a href="productPage.php?id=<?php echo nl2br (htmlspecialchars($product3Details['productID']));?>"><img src="<?php echo nl2br(htmlspecialchars($product3Details['image1Path']));?>"class="recommendedProduct"></a>
<u><p><?php echo nl2br (htmlspecialchars($product3Details['name']));?></p><br></u>
</div>
</div>
    </div>
    <div id="extra-details">
        <p id="materials">More Information</p>
    <div id="full-description" hidden >
        <p><?php echo nl2br(htmlspecialchars($productDetails['material']));?></p>
        <p>Product code: <?php echo nl2br(htmlspecialchars($productDetails['productID']));?></p>
    </div>
    <p id="returns">Return Policy</p>
    <div id="return-policy" hidden> 
        <p id="policy-text">We are happy to refund or exchange any item within 28 days of purchase, 
        provided the item is returned in a saleable condition with an original receipt. View full details of our Returns Policy.</p>
    </div>
    </div>
</body>
</html>