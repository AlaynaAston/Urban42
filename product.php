<?php
// product.php — template to display a single product

if (!isset($product) || !is_array($product)) {
    echo "<h1>No product data found</h1>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($product['name']) ?></h1>
    <p><strong>Price:</strong> £<?= number_format($product['price'], 2) ?></p>
    <p><?= htmlspecialchars($product['description']) ?></p>
    <p><strong>Stock:</strong> <?= (int)$product['stock'] ?></p>
    <img src="<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="max-width:300px;">
</body>
</html>