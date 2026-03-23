<?php
$pageTitle = "Classic Hoodie";
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<div class="product-page">

    <div class="product-grid">

        <!-- LEFT: PRODUCT IMAGES -->
        <div class="product-media">
            <img src="/images/hoodie-classic.jpg" alt="Classic Hoodie" class="product-main-image">

            <div class="thumbs">
                <img src="/images/hoodie-classic.jpg" class="thumb">
                <img src="/images/hoodie-classic-2.jpg" class="thumb">
                <img src="/images/hoodie-classic-3.jpg" class="thumb">
            </div>
        </div>

        <!-- RIGHT: PRODUCT DETAILS -->
        <div class="product-summary">

            <h1 class="product-title">Urban42 Classic Hoodie</h1>

            <div class="product-price">£49.99</div>

            <p class="product-desc">
                The Urban42 Classic Hoodie blends premium comfort with a sleek, minimalist streetwear aesthetic.
                Made from a soft heavyweight cotton blend, this everyday essential keeps you warm and stylish all year round.
            </p>

            <div class="product-stock">
                <span class="in-stock">✔ In Stock</span>
            </div>

            <!-- ADD TO CART FORM -->
            <form class="add-to-cart" action="/cart-add.php" method="POST">
                <input type="hidden" name="product_id" value="hoodie-classic">
                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']); ?>">
