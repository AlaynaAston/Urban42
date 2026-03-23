<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<div class="container">
    <h1>Search Results</h1>

<?php
if (isset($_GET['query'])) {

    $search = $_GET['query'];

    // Prepared statement (SECURE)
    $stmt = $conn->prepare(
        "SELECT * FROM Product 
         WHERE name LIKE ? 
         OR description LIKE ?"
    );

    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        echo '<div class="product-grid">';

        while ($row = $result->fetch_assoc()) {

            echo '
            <div class="product-card">
                <div class="image-box">
                    <img src="' . $row["image1Path"] . '" alt="">
                </div>

                <h2 class="product-title">' . $row["name"] . '</h2>

                <p class="description">
                    ' . substr($row["description"], 0, 80) . '...
                </p>

                <p class="price">£' . $row["price"] . '</p>
            </div>
            ';
        }

        echo '</div>';

    } else {
        echo "<p>No products found.</p>";
    }

    $stmt->close();
}
?>

</div>

<?php include 'includes/footer.php'; ?>