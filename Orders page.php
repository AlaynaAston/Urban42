<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Orders — Urban 42</title>
  <link rel="stylesheet" href="Orderspagestyle.css" />
</head>
<body>
  <div class="navbar">
  <div class="nav-left">
    <div class="sidebar-icon">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
    <div class="brand-logo">
      <img src="urban42.png" alt="Urban 42 Logo">
      <span>Urban 42</span>
    </div>
  </div>
  <div class="nav-right">
    <img src="ukflag.jpg" alt="UK Flag" class="flag-icon">
    <span>GBP £</span>
    <a href="ContactPage.php">Help</a>
    <a href="login.html">Log in</a>
    <a><form class="search-form">
      <input type="text" placeholder="Search..." name="search">
      <button type="submit">🔍</button>
    </form></a>
    <a href="basket.html">Cart</a>

     <div class="profile-section">
            <img src="default-profile.jpg" alt="Profile" class="profile-icon">
            <div class="profile-dropdown">
                <a href="Profile.php">My Profile</a>
                <a href="Orders page.php">My Orders</a>
                <a href="#">Settings</a>
                <a href="#">Log Out</a>
            </div>
    </div>
  </div>

  <div class="orders-section">
    <section id="wishlist">
      <h2>My Wishlist</h2>
      <div class="wishlist-grid">
        <div class="wishlist-card">
          <p><strong>Urban Hoodie</strong></p>
          <button>Add to Cart</button>
        </div>
        <div class="wishlist-card">
          <p><strong>Denim Jacket</strong></p>
          <button>Add to Cart</button>
        </div>
        <div class="wishlist-card">
          <p><strong>Leather Boots</strong></p>
          <button>Add to Cart</button>
        </div>
      </div>
    </section>

    <section id="current-orders">
      <h2>Current Orders</h2>
      <table>
        <tr>
          <th>Order ID</th>
          <th>Date</th>
          <th>Items</th>
          <th>Status</th>
          <th>Tracking</th>
        </tr>
        <tr>
          <td>#U42-12345</td>
          <td>15 Nov 2025</td>
          <td>Urban Hoodie, Sneakers</td>
          <td>Shipped</td>
          <td><a href="#">Track Order</a></td>
        </tr>
        <tr>
          <td>#U42-12346</td>
          <td>27 Nov 2025</td>
          <td>Denim Jacket</td>
          <td>Processing</td>
          <td><a href="#">Track Order</a></td>
        </tr>
      </table>
    </section>

    <section id="previous-orders">
      <h2>Previous Orders</h2>
      <table>
        <tr>
          <th>Order ID</th>
          <th>Date</th>
          <th>Items</th>
          <th>Status</th>
        </tr>
        <tr>
          <td>#U42-12200</td>
          <td>05 Oct 2025</td>
          <td>Graphic Tee</td>
          <td>Delivered</td>
        </tr>
        <tr>
          <td>#U42-12150</td>
          <td>15 Sep 2025</td>
          <td>Leather Boots</td>
          <td>Delivered</td>
        </tr>
      </table>
    </section>

    <section id="tracking">
      <h2>Track an Order</h2>
      <form>
        <label for="tracking-id">Enter Order ID:</label>
        <input type="text" id="tracking-id" name="tracking-id" required>
        <button type="submit">Track</button>
      </form>
    </section>

    <div class="return-form">
    <section id="returns">
      <h2>Returns & Refunds</h2>
      <form>
        <label for="return-order-id">Order ID:</label>
        <input type="text" id="return-order-id" name="return-order-id" required>

        <label for="reason">Reason for Return:</label>
        <select id="reason" name="reason" required>
          <option value="">Select</option>
          <option value="size">Wrong Size</option>
          <option value="faulty">Faulty Item</option>
          <option value="wrong-item">Wrong Item Sent</option>
          <option value="other">Other</option>
        </select>

        <label for="details">Additional Details:</label>
        <textarea id="details" name="details" rows="4"></textarea>

        <button type="submit">Submit Request</button>
      </form>
    </section>
    </div>
  </div>

</body>
</html>