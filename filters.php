<form method="GET" class="filter-bar">

    <!-- Keep search query -->
    <input type="hidden" name="query" value="<?php echo $_GET['query'] ?? ''; ?>">

    <label>Min Price:</label>
    <input type="number" name="min_price" placeholder="£0">

    <label>Max Price:</label>
    <input type="number" name="max_price" placeholder="£100">

    <button type="submit" class="btn primary">Filter</button>

</form>
