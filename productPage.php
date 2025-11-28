<?php 
    include('db.php');
    session_start();

    $_SESSION["userID"] = "1"; //some hard coding ill use for now until the user account functionality has been made
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitted'])) { 
        $user_id = $_SESSION['userID'];
        $productID = $_POST['productID'];
        $productSize = $_POST['sizes'];
        $productQuantity = $_POST['quantity'];
        
         $stmt = $db->prepare("INSERT INTO baskets (userID, productID, quantity, size) VALUES (?, ?, ?, ?)");
         $stmt->execute([$user_id, $productID, $productQuantity, $productSize]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Product</title>
    <link href="styles.css" rel="stylesheet">
    <link href="navbarstyling.css" rel="stylesheet">
    <script src="scripts.js" defer></script>
</head>

<body>
  <div class="navbar">
  <div class="nav-left">
    <div class="sidebar-icon">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
    <div class="brand-logo">
      <img src="Urban42logo.png" alt="Urban 42 Logo">
      <span>Urban 42</span>
    </div>
  </div>
  <div class="nav-right">
    <img src="ukflag.png" alt="UK Flag" class="flag-icon">
    <span>GBP £</span>
    <a href="#">Help</a>
    <a href="#">Log in</a>
    <a><form class="search-form">
      <input type="text" placeholder="Search..." name="search">
      <button type="submit">🔍</button>
    </form></a>
    <a href="#">Cart</a>
    </div>
  </div>
    <div id="product-details">
        <div class="carousel" data-carousel aria-label="Product Photos">
            <button class="carousel-button prev" data-carousel-button="prev">&#60;</button>
            <button class="carousel-button next" data-carousel-button="next">&#62;</button>
            <ul data-slides>
                <li class="slide">
                    <img src="./hi top trainer front no bg.png" alt="Front of High Top Trainer">
                </li>
                <li class="slide" data-active>
                    <img src="./hi top trainer side no bg.png" alt="Side of High Top Trainer">
                </li>
                <li class="slide">
                    <img src="./hi top trainer back no bg.png" alt="Back of High Top Trainer">
                </li>
            </ul>
        </div>
        <div id="product-text">
            <div id="product-title">
                <p>Hi-top Ultimate Trainer in Black</p>
            </div>
            <div id="price">
                <p>£42.99</p>
            </div>
            <div id="stockCount">
                <p>In Stock</p>
            </div>
            <div id="short-description">
                <p>A sleek yet casual style trainer with a futuristic black design. Paired with comfortable cushioned
                    soles, these trainers are perfect for everyday wear.</p>
            </div>
            <form method="POST">
                <input type="hidden" name="submitted" value="1">
                <div id="inputSize">
                    <label>Size: </label><br>
                    <select name="sizes" class="sizes" required>
                        <option value="" disabled selected>Select size: </option>
                        <option value="3">3</option>
                        <option value="3.5">3 1/2</option>
                        <option value="4">4</option>
                        <option value="4.5">4 1/2</option>
                        <option value="5">5</option>
                        <option value="5.5">5 1/2</option>
                        <option value="6">6</option>
                        <option value="6.5">6 1/2</option>
                        <option value="7">7</option>
                        <option value="7.5">7 1/2</option>
                        <option value="8">8</option>
                        <option value="8.5">8 1/2</option>
                        <option value="9">9</option>
                    </select>
                </div>
                <div id="inputQuantity">
                    <label>Quantity: </label><br>
                    <input type="number" min="1" value="1" name="quantity">
                </div>
                <input hidden value="5" name="productID">
                <div class="checkout"><input type="submit" value="Add to Basket"></div><!-- there should be some php here tracks what the user put in our form and puts it in the basket-->
                <!--<div class="checkout"><input type="submit" value="Buy Now"></div> -->
            </form>
        </div>
    </div>
    <div id="extra-details">
        <p id="materials">Materials</p>
    <div id="full-description" hidden >
        <ul>
            <li>LINING: Fabric</li>
            <li>UPPER: Suede </li>
            <li>OUTER SOLE: Rubber</li>
            <li>Product code: 23482518</li> <!--will use Product ID here-->
        </ul>
    </div>
    <p id="returns">Return Policy</p>
    <div id="return-policy" hidden> 
        <p id="policy-text">We are happy to refund or exchange any item within 28 days of purchase, 
        provided the item is returned in a saleable condition with an original receipt. View full details of our Returns Policy.</p>
    </div>
    </div>
</body>

</html>