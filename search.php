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

<a href="product.php?id=<?php echo $p["productID"]; ?>">View Product</a>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<p>No products found.</p>

<?php endif; ?>

</body>
</html>