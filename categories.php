<?php
require 'db.php';

/* Get selected category */
$category = "";

if (isset($_GET["category"])) {
    $category = trim($_GET["category"]);
}

/* Build query */
$query = "
    SELECT productID, name, price, image1Path
    FROM Product
";

$params = [];

if (!empty($category)) {
    $query .= " WHERE category = ?";
    $params[] = $category;
}

$stmt = $db->prepare($query);
$stmt->execute($params);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .categories {
            margin-bottom: 20px;
        }

        .categories a {
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
            color: black;
        }

        .categories a:hover {
            text-decoration: underline;
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-card {
            border: 1px solid #ccc;
            padding: 10px;
            width: 200px;
            text-align: center;
        }

        .product-card img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

<h1>
<?php if ($category): ?>
    <?php echo ucfirst(htmlspecialchars($category)); ?>
<?php else: ?>
    All Products
<?php endif; ?>
</h1>

<!-- Category Navigation -->
<div class="categories">
    <a href="products.php?category=tops">Tops</a>
    <a href="products.php?category=bottoms">Bottoms</a>
    <a href="products.php?category=shoes">Shoes</a>
    <a href="products.php?category=accessories">Accessories</a>
    <a href="products.php">All</a>
</div>

<!-- Product Display -->
<?php if ($products): ?>

<div class="product-grid">

<?php foreach ($products as $p): ?>

<div class="product-card">

<img src="<?php echo $p["image1Path"]; ?>">

<h3><?php echo htmlspecialchars($p["name"]); ?></h3>

<p>£<?php echo $p["price"]; ?></p>

<a href="product.php?id=<?php echo $p["productID"]; ?>">View Product</a>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<p>No products in this category.</p>

<?php endif; ?>

</body>
</html>