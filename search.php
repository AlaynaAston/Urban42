<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<div class="container">
    <h1>Search Results</h1>

    <!-- FILTER BAR -->
    <?php include 'includes/filters.php'; ?>

<?php

$conditions = [];
$params = [];
$types = "";

/* SEARCH */
if (!empty($_GET['query'])) {
    $conditions[] = "(name LIKE ? OR description LIKE ?)";
    $searchTerm = "%" . $_GET['query'] . "%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= "ss";
}

/* MIN PRICE */
if (!empty($_GET['min_price'])) {
    $conditions[] = "price >= ?";
    $params[] = $_GET['min_price'];
    $types .= "d";
}

/* MAX PRICE */
if (!empty($_GET['max_price'])) {
    $conditions[] = "price <= ?";
    $params[] = $_GET['max_price'];
    $types .= "d";
}

/* BUILD QUERY */
$sql = "SELECT * FROM Product";

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

/* DISPLAY RESULTS */

if ($result->num_rows > 0) {

    echo '<div class="product-grid">';

    while ($row = $result->fetch_assoc()) {

        echo '
        <div class="product-card">

            <div class="image-box">
                <img src="/Urban42/' . $row["image1Path"] . '" alt="' . $row["name"] . '">
            </div>

            <h2 class="product-title">' . $row["name"] . '</h2>

            <p class="description">
                ' . substr($row["description"], 0, 60) . '...
            </p>

            <div class="bottom-row">
                <p class="price">£' . $row["price"] . '</p>

                <a href="/Urban42/cart.php?productID=' . $row["productID"] . '" class="btn primary">
                    Add to Cart
                </a>
            </div>

        </div>
        ';
    }

    echo '</div>';

} else {
    echo "<p>No products found.</p>";
}

$stmt->close();
?>

</div>

<?php include 'includes/footer.php'; ?>