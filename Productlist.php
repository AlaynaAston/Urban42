//we dont have a product list page yet so ive made this
//whoever does the product list page can you please use code similar like this so when a user clicks on a product,
//the prooductID is passed to the url of productPage.php. it wont work otherwise. 

<?php
require 'db.php';

$sql = "SELECT products.* FROM products";
$products = $db->query($sql);
$productDetails = $products->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($productDetails as $product): ?>
    <a href="productPage.php?id=<?php echo $product['productID']; ?>">  <p id="smalltext"><?php echo nl2br(htmlspecialchars($product['name'])); ?></p> </a>
        <?php endforeach; ?>
</body>
</html>