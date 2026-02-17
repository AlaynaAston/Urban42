

<?php
require 'testdb.php';

$sql = "SELECT products.* FROM products";
$products = $db->query($sql);
$productDetails = $products->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitted'])) {
    $name = $_POST['name'];
    $availableStock= $_POST['availableStock'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $material = $_POST['material'];
    $category = $_POST['category'];
    $size = $_POST['size'];
    $colour = $_POST['colour'];
    
    $image1Name = $_FILES['image1']['name'];
    $image1TmpPath = $_FILES['image1']['tmp_name'];
    $image1Size = $_FILES['image1']['size'];
    $image1Type = $_FILES['image1']['type'];

    $image2Name = $_FILES['image2']['name'];
    $image2TmpPath = $_FILES['image2']['tmp_name'];
    $image2Size = $_FILES['image2']['size'];
    $image2Type = $_FILES['image2']['type'];
    
    $image3Name = $_FILES['image3']['name'];
    $image3TmpPath = $_FILES['image3']['tmp_name'];
    $image3Size = $_FILES['image3']['size'];
    $image3Type = $_FILES['image3']['type'];

    
    
        
        $ext1 = pathinfo($image1Name, PATHINFO_EXTENSION);  
        $newFileName1 = uniqid('img_', true) . '.' . $ext1;
        $uploadDir = 'images/';
        $destPath1 = $uploadDir . $newFileName1;

        $ext2 = pathinfo($image2Name, PATHINFO_EXTENSION);  
        $newFileName2 = uniqid('img_', true) . '.' . $ext2;
        $destPath2 = $uploadDir . $newFileName2;

        $ext3 = pathinfo($image3Name, PATHINFO_EXTENSION);  
        $newFileName3 = uniqid('img_', true) . '.' . $ext3;
        $destPath3 = $uploadDir . $newFileName3;

        $stmt = $db->prepare("INSERT INTO products (availableStock, price, name, description, material, category, size, colour, image1Path, image2Path, image3Path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$availableStock, $price, $name, $description, $material, $category, $size, $colour, $destPath1, $destPath2, $destPath3]);

        move_uploaded_file($image1TmpPath, $destPath1);
        move_uploaded_file($image2TmpPath, $destPath2);
        move_uploaded_file($image3TmpPath, $destPath3);

    

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add New Product</h1>
    <form method="POST" id="form" enctype="multipart/form-data" action="productList.php">
        <input type="hidden" name="submitted" value="1">
        <label for="productname">Enter Product Name:</label>
        <input name="name" placeholder="Product Name..." id="name" required type="text" maxlength="255"><br>
        
        <label for="availableStock">Select Product Stock:</label>
        <input name="availableStock" placeholder="1" id="availableStock" required type="number" min="1"><br>
        <label for="price">Enter Price:</label>
        <input name="price" placeholder="£..." id="price" required type="number" step="any"><br>
        <label for="description">Describe the Product: </label>
        <textarea name="description" placeholder="Enter a description" id="description" required type="text" maxlength="500"></textarea><br>
        <label for="material">Describe the materials: </label>
        <textarea name="material" placeholder="Materials" id="description" required type="text" maxlength="200"></textarea><br>
       
        <label for="category">Product Category: </label><br>
        <input type="radio" name="category" class="radio" value="clothing" required>
        <label for="clothing">Clothing</label><br>
        <input type="radio" name="category" class="radio" value="shoes">
        <label for="shoes">Shoes</label><br>
        <input type="radio" name="category" class="radio" value="bags">
        <label for="bags">Bags</label><br>
        <input type="radio" name="category" class="radio" value="accessories">
        <label for="accessories">Accessories</label><br>

        <label for="size">Product Size: </label>
        <select name="size" class="sizes" required> 
            <option value="" disabled selected>Select size: </option>
            <option value="XS">Extra Small</option>
            <option value="S">Small</option>
            <option value="M">Medium</option>
            <option value="L">Large</option>
            <option value="XL">Extra Large</option>
            <option value="XXL">XX-Large</option>
        </select> <br>
        <label for="colour">Product Colour: </label>
        <input type="text" name="colour" maxlength="50" required placeholder="Colour..."><br>
        <label for="image">Provide 3 images for this Product: </label><br>
        <input name="image1" type="file" accept="image/*" required id="image1"><br>
        <input name="image2" type="file" accept="image/*" required id="image2"><br>
        <input name="image3" type="file" accept="image/*" required id="image3"><br>
        <input type="submit" id="submit">
    </form>
    <h1>Current Products</h1>
    <?php foreach($productDetails as $product): ?>
    <a href="productPage.php?id=<?php echo $product['productID']; ?>">  <p id="smalltext"><?php echo nl2br(htmlspecialchars($product['name'])); ?></p> </a>
        <?php endforeach; ?>
</body>
</html>