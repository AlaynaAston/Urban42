<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["user_id"];

/* Get user info */
$userStmt = $db->prepare("
    SELECT fullName, email, phone 
    FROM Users 
    WHERE userID = ?
");
$userStmt->execute([$userID]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

/* Get orders */
$orderStmt = $db->prepare("
    SELECT orderID, orderDate, totalAmount, status 
    FROM Orders 
    WHERE userID = ?
    ORDER BY orderDate DESC
");
$orderStmt->execute([$userID]);
$orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <style>
    :root {
      --bg-color: #f5f7fb;
      --card-bg: #ffffff;
      --text-main: #1f2933;
      --text-muted: #6b7280;
      --accent: #2563eb;
      --accent-soft: #dbeafe;
      --border-color: #e5e7eb;
      --success: #16a34a;
      --warning: #ea580c;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    body {
      background: var(--bg-color);
      color: var(--text-main);
      padding: 2rem 1rem;
    }

    .page-header {
      max-width: 600px;
      margin: 0 auto 1.5rem;
      text-align: center;
    }

    .page-header h1 {
      font-size: 1.8rem;
      font-weight: 700;
      margin-bottom: 0.4rem;
    }

    .page-header p {
      color: var(--text-muted);
      font-size: 0.95rem;
    }

    .profile-wrapper {
      max-width: 600px;
      margin: 0 auto;
    }

    .profile-card {
      background: var(--card-bg);
      border-radius: 1rem;
      border: 1px solid var(--border-color);
      padding: 1.5rem;
      box-shadow: 0 10px 25px rgba(15, 23, 42, 0.03);
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .profile-header {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .profile-photo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--accent-soft);
    }

    .profile-main {
      flex: 1;
    }

    .profile-name {
      font-weight: 600;
      font-size: 1.2rem;
      margin-bottom: 0.25rem;
    }
    /* PROFILE BUTTON STYLE */
.profile-btn {
  border: none;
  cursor: pointer;
  font-size: 0.8rem;
  padding: 0.45rem 0.9rem;
  border-radius: 999px;
  background: var(--accent);
  color: white;
  font-weight: 500;
  transition: transform 0.08s ease, box-shadow 0.1s ease, background 0.2s ease;
}

.profile-btn:hover {
  background: #1d4ed8;
  box-shadow: 0 4px 10px rgba(37,99,235,0.3);
  transform: translateY(-1px);
}

.profile-btn:active {
  transform: translateY(0);
  box-shadow: none;
}

/* PHOTO FORM */
.photo-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.4rem;
}

.photo-form input[type="file"] {
  font-size: 0.75rem;
}

/* MEMBERSHIP FORM */
.membership-form {
  display: flex;
  gap: 0.4rem;
  margin-top: 0.4rem;
}

.membership-select {
  padding: 0.3rem 0.45rem;
  border-radius: 6px;
  border: 1px solid var(--border-color);
  font-size: 0.8rem;
  background: white;
}

/* SMALL MOBILE IMPROVEMENT */
@media (max-width:480px){

  .membership-form{
    flex-direction: column;
    align-items: flex-start;
  }

}

    .membership-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      font-size: 0.8rem;
      padding: 0.15rem 0.6rem;
      border-radius: 999px;
      background: var(--accent-soft);
      color: var(--accent);
      font-weight: 500;
    }

    .membership-badge span.dot {
      width: 7px;
      height: 7px;
      border-radius: 999px;
      background: var(--accent);
    }

    .membership-gold {
      background: #fef3c7;
      color: #b45309;
    }

    .membership-gold .dot {
      background: #b45309;
    }

    .membership-silver {
      background: #e5e7eb;
      color: #374151;
    }

    .membership-silver .dot {
      background: #4b5563;
    }

    .membership-standard {
  background: #555;
  color: white;
}
.membership-standard .dot {
      background: #3fa161;
    }

    .status-pill {
      margin-left: auto;
      font-size: 0.75rem;
      padding: 0.2rem 0.6rem;
      border-radius: 999px;
      background: #dcfce7;
      color: var(--success);
      font-weight: 500;
      white-space: nowrap;
    }

    .status-pill.inactive {
      background: #fef3c7;
      color: var(--warning);
    }

    .section-title {
      font-size: 0.85rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      color: var(--text-muted);
      margin-bottom: 0.35rem;
    }

    .contact-details,
    .order-summary {
      border-radius: 0.75rem;
      border: 1px dashed var(--border-color);
      padding: 0.75rem 0.9rem;
      display: grid;
      gap: 0.35rem;
      font-size: 0.9rem;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      gap: 0.75rem;
    }

    .detail-label {
      color: var(--text-muted);
    }

    .detail-value {
      font-weight: 500;
      text-align: right;
      word-break: break-word;
    }

    .order-summary .detail-value {
      font-weight: 600;
    }

    .order-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 0.5rem;
      gap: 0.75rem;
      flex-wrap: wrap;
    }

    .order-status-chip {
      font-size: 0.75rem;
      padding: 0.2rem 0.5rem;
      border-radius: 999px;
      background: #eef2ff;
      color: #4338ca;
      font-weight: 500;
    }

    .toggle-orders-btn {
      border: none;
      cursor: pointer;
      font-size: 0.8rem;
      padding: 0.4rem 0.75rem;
      border-radius: 999px;
      background: var(--accent);
      color: white;
      font-weight: 500;
      transition: transform 0.08s ease, box-shadow 0.08s ease, background 0.15s ease;
      white-space: nowrap;
    }

    .toggle-orders-btn:hover {
      background: #1d4ed8;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
      transform: translateY(-1px);
    }

    .toggle-orders-btn:active {
      transform: translateY(0);
      box-shadow: none;
    }

    .orders-list {
      margin-top: 0.65rem;
      border-top: 1px solid var(--border-color);
      padding-top: 0.55rem;
      display: none;
    }

    .order-item {
      font-size: 0.85rem;
      padding: 0.4rem 0;
      display: flex;
      justify-content: space-between;
      gap: 0.5rem;
      border-bottom: 1px dashed #e5e7eb;
    }

    .order-item:last-child {
      border-bottom: none;
    }

    .order-id {
      font-weight: 500;
    }

    .order-meta {
      text-align: right;
      color: var(--text-muted);
    }

    @media (max-width: 480px) {
      .profile-header {
        align-items: flex-start;
      }

      .detail-row {
        flex-direction: column;
        align-items: flex-start;
      }

      .detail-value,
      .order-meta {
        text-align: left;
      }

      .page-header {
        text-align: left;
      }
    }
  </style>
</head>
<body>
  <header class="page-header">
    <h1>User Profile</h1>
    <p>Profile, membership status, contact details and order history for this user.</p>
  </header>

  <main class="profile-wrapper">
<section class="profile-card">

  <!-- HEADER -->
 <div class="profile-header">

  <div class="photo-section">
    <img class="profile-photo"
    src="<?= !empty($user['profilePhoto']) ? $user['profilePhoto'] : 'team-img5.png'; ?>"
    alt="Profile photo">

    <form action="upload_photo.php" method="POST" enctype="multipart/form-data" class="photo-form">
      <input type="file" name="photo" accept="image/*" required>
      <button type="submit" class="profile-btn">Change Photo</button>
    </form>
  </div>

  <div class="profile-main">

    <div class="profile-name"><?= htmlspecialchars($user["fullName"]) ?></div>

<?php
$membership = $user["membership"] ?? "Standard";
$class = strtolower($membership);
?>

<div class="membership-badge membership-<?= $class ?>">
  <span class="dot"></span>
  <span><?= htmlspecialchars($membership) ?> Member</span>
</div>

<form action="update_membership.php" method="POST" class="membership-form">

<select name="membership" class="membership-select" required>
  <option value="Standard">Standard</option>
  <option value="Silver">Silver</option>
  <option value="Gold">Gold</option>
</select>

<button type="submit" class="profile-btn">Update</button>

</form>

  </div>

  <div class="status-pill">Active</div>

</div>

  <!-- CONTACT -->
  <div class="section-title">Contact Details</div>
  <div class="contact-details">

    <div class="detail-row">
      <div class="detail-label">Email</div>
      <div class="detail-value"><?= htmlspecialchars($user["email"]) ?></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Phone</div>
      <div class="detail-value"><?= htmlspecialchars($user["phone"]) ?></div>
    </div>

  </div>

  <!-- ORDERS -->
  <div class="section-title">Order Details</div>
  <div class="order-summary">

    <div class="detail-row">
      <div class="detail-label">Total Orders</div>
      <div class="detail-value"><?= count($orders) ?></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Last Order</div>
      <div class="detail-value">
        <?php if ($orders): ?>
          #<?= $orders[0]["orderID"] ?> • <?= $orders[0]["orderDate"] ?>
        <?php else: ?>
          No orders yet
        <?php endif; ?>
      </div>
    </div>

    <div class="order-actions">
      <div class="order-status-chip">
        <?= $orders ? "Latest: ".$orders[0]["status"] : "No recent orders" ?>
      </div>

      <button class="toggle-orders-btn" type="button" onclick="toggleOrders()">View Orders</button>
    </div>

    <div class="orders-list" id="ordersList" style="display:none;">
      <?php if ($orders): ?>
        <?php foreach ($orders as $o): ?>
          <div class="order-item">
            <div class="order-id">#<?= $o["orderID"] ?></div>
            <div class="order-meta">
              <?= $o["orderDate"] ?> • £<?= $o["totalAmount"] ?> • <?= $o["status"] ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div style="font-size:0.85rem;color:#9ca3af;">
          This user has no previous orders.
        </div>
      <?php endif; ?>
    </div>

  </div>

</section>
</main>

<script>
function toggleOrders() {
  const list = document.getElementById("ordersList");
  const btn = document.querySelector(".toggle-orders-btn");
  const open = list.style.display === "block";
  list.style.display = open ? "none" : "block";
  btn.textContent = open ? "View Orders" : "Hide Orders";
}
</script>

</body>
</html>
