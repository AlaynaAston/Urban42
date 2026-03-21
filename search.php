<?php
require 'db.php';

$search = "";

if (isset($_GET["search"])) {
    $search = trim($_GET["search"]);
}

/* Find products */
$stmt = $db->prepare("
    SELECT productID, name, price, image1Path
    FROM Product
    WHERE name LIKE ?
       OR description LIKE ?
");

$keyword = "%" . $search . "%";

$stmt->execute([$keyword, $keyword]);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>

body {
  font-family: Arial, sans-serif;
  background: #f5f7fa;
  margin: 0;
  padding: 20px;
}

/* Title */
h1 {
  text-align: center;
  margin-bottom: 30px;
}

/* Grid layout */
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
}

/* Product card */
.product-card {
  background: #fff;
  border-radius: 12px;
  padding: 15px;
  text-align: center;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: 0.3s ease;
}

/* Hover effect */
.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 18px rgba(0,0,0,0.15);
}

/* Product image */
.product-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 10px;
}

/* Product name */
.product-card h3 {
  font-size: 18px;
  margin: 10px 0;
}

/* Price */
.product-card p {
  font-size: 16px;
  font-weight: bold;
  color: #2c7be5;
  margin-bottom: 10px;
}

/* Button */
.product-card a {
  display: inline-block;
  padding: 8px 14px;
  background: #2c7be5;
  color: white;
  text-decoration: none;
  border-radius: 6px;
  transition: 0.2s;
}

.product-card a:hover {
  background: #1a5edb;
}

/* No results text */
p {
  text-align: center;
  font-size: 18px;
}
</style>

<!DOCTYPE html>
<html>
<head>
<title>Search Results</title>
</head>

<body>

<h1>Search Results for "<?php echo htmlspecialchars($search); ?>"</h1>

<?php if ($products): ?>

<div class="product-grid">

<?php foreach ($products as $p): ?>

<div class="product-card">

<img src="<?php echo $p["image1Path"]; ?>" width="200">

<h3><?php echo htmlspecialchars($p["name"]); ?></h3>

<p>£<?php echo $p["price"]; ?></p>

<a href="productPageFiles/product.php?id=<?php echo $p["productID"]; ?>">View Product</a>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<p>No products found.</p>

<?php endif; ?>

</body>
</html>