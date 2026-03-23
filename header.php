<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urban42</title>

    <!-- ✅ FIXED CSS PATH -->
    <link rel="stylesheet" href="/Urban42/style.css">
</head>

<body>

<div class="topbar">
    <div class="container topbar-inner">

        <div class="logo">Urban42</div>

        <nav class="nav">
            <a href="/Urban42/index.php">Home</a>
            <a href="/Urban42/products.php">Products</a>
            <a href="/Urban42/size-chart.php">Size Guide</a>
            <a href="/Urban42/contact.php">Contact</a>
        </nav>

        <!-- SEARCH BAR -->
        <div class="search-bar">
            <form action="/Urban42/search.php" method="GET">
                <input type="text" name="query" placeholder="Search products..." required>
                <button type="submit">🔍</button>
            </form>
        </div>

        <div class="actions">
            <button class="btn small outline">Login</button>
            <button class="btn small primary">Sign Up</button>
        </div>

    </div>
</div>