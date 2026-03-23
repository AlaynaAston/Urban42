<?php 
require 'db.php';

$search = "";
$min_price = "";
$max_price = "";

if (isset($_GET["search"])) {
    $search = trim($_GET["search"]);
}

if (isset($_GET["min_price"])) {
    $min_price = $_GET["min_price"];
}

if (isset($_GET["max_price"])) {
    $max_price = $_GET["max_price"];
}

/* BUILD QUERY */
$sql = "
    SELECT productID, name, price, image1Path
    FROM Product
    WHERE (name LIKE :search OR description LIKE :search)
";

$params = [
    ':search' => "%" . $search . "%"
];

/* ADD PRICE FILTERS */
if ($min_price !== "") {
    $sql .= " AND price >= :min_price";
    $params[':min_price'] = (float)$min_price;
}

if ($max_price !== "") {
    $sql .= " AND price <= :max_price";
    $params[':max_price'] = (float)$max_price;
}

$stmt = $db->prepare($sql);
$stmt->execute($params);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<style>
    /* PAGE */
body {
  font-family: 'Segoe UI', sans-serif;
  background: var(--bg-color);
  color: var(--text);
  margin: 0;
  padding: 20px;
}

/* TITLE */
h1 {
  text-align: center;
  margin-bottom: 30px;
}
/* FILTER BAR */
.filter-form {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-bottom: 25px;
  flex-wrap: wrap;
}

.filter-form input {
  padding: 8px 12px;
  border-radius: 6px;
  border: 1px solid var(--input-border);
  outline: none;
}

.filter-form button {
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;

  background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
  color: white;
}

/* GRID LAYOUT */
.product-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 25px;
}

/* CARD */
.product-card {
  width: 220px;
  padding: 15px;

  /*  Gradient  */
  background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));

  border-radius: 16px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.15);

  text-align: center;
  color: white;

  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

/* HOVER */
.product-card:hover {
  transform: translateY(-6px) scale(1.03);
  box-shadow: 0 12px 28px rgba(67, 97, 238, 0.4);
}

/* IMAGE */
.product-card img {
  width: 100%;
  height: 160px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 10px;

  /* stylish overlay effect */
  opacity: 0.9;
  mix-blend-mode: overlay;
}

/* NAME */
.product-card h3 {
  font-size: 1.1rem;
  margin: 10px 0 5px;
}

/* PRICE */
.product-card p {
  font-weight: bold;
  margin-bottom: 10px;
}

/* BUTTON */
.product-card a {
  display: inline-block;
  padding: 8px 14px;
  border-radius: 8px;
  text-decoration: none;
  background: rgba(255,255,255,0.2);
  color: white;
  font-size: 14px;
  transition: 0.3s;
}

/* BUTTON HOVER */
.product-card a:hover {
  background: white;
  color: var(--gradient-start);
}

/* NO RESULTS */
p {
  text-align: center;
  font-size: 1.1rem;
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

    <form method="GET" class="filter-form">

  <input type="text" name="search" placeholder="Search..."
    value="<?php echo htmlspecialchars($search); ?>">

  <input type="number" name="min_price" placeholder="Min £"
    value="<?php echo htmlspecialchars($min_price); ?>">

  <input type="number" name="max_price" placeholder="Max £"
    value="<?php echo htmlspecialchars($max_price); ?>">

  <button type="submit">Filter</button>

</form>

<div class="product-grid">

<?php foreach ($products as $p): ?>

<div class="product-card">

<img src="<?php echo $p["image1Path"]; ?>" width="200">

<h3><?php echo htmlspecialchars($p["name"]); ?></h3>

<p>Â£<?php echo $p["price"]; ?></p>

<a href="product.php?id=<?php echo $p["productID"]; ?>">View Product</a>

</div>

<?php endforeach; ?>

</div>

<?php else: ?>

<p>No products found.</p>

<?php endif; ?>

</body>
</html>