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
    <section id="profileContainer"></section>
  </main>

  <script>
    const userProfile = {
      name: "John Doe",
      photo: "team-img5.png",
      membership: "Gold",
      active: true,
      contact: {
        email: "john.doe@gmail.com",
        phone: "+44 7700 900111",
        address: "12 Starling Street, London, UK"
      },
      orders: [
        { id: "#20001", date: "2025-11-20", total: "£59.99", status: "Delivered" },
        { id: "#19987", date: "2025-10-05", total: "£23.50", status: "Delivered" }
      ]
    };

    function createProfileCard(profile) {
      const card = document.createElement("article");
      card.className = "profile-card";

      const header = document.createElement("div");
      header.className = "profile-header";

      const img = document.createElement("img");
      img.className = "profile-photo";
      img.src = profile.photo;
      img.alt = profile.name;

      const main = document.createElement("div");
      main.className = "profile-main";

      const nameEl = document.createElement("div");
      nameEl.className = "profile-name";
      nameEl.textContent = profile.name;

      const membershipBadge = document.createElement("div");
      membershipBadge.className = "membership-badge";

      if (profile.membership.toLowerCase() === "gold") {
        membershipBadge.classList.add("membership-gold");
      } else if (profile.membership.toLowerCase() === "silver") {
        membershipBadge.classList.add("membership-silver");
      }

      const dot = document.createElement("span");
      dot.className = "dot";

      const label = document.createElement("span");
      label.textContent = profile.membership + " Member";

      membershipBadge.appendChild(dot);
      membershipBadge.appendChild(label);

      main.appendChild(nameEl);
      main.appendChild(membershipBadge);

      const statusPill = document.createElement("div");
      statusPill.className = "status-pill";
      statusPill.textContent = profile.active ? "Active" : "Inactive";
      if (!profile.active) {
        statusPill.classList.add("inactive");
      }

      header.appendChild(img);
      header.appendChild(main);
      header.appendChild(statusPill);

      const contactTitle = document.createElement("div");
      contactTitle.className = "section-title";
      contactTitle.textContent = "Contact Details";

      const contactBox = document.createElement("div");
      contactBox.className = "contact-details";

      const rows = [
        ["Email", profile.contact.email],
        ["Phone", profile.contact.phone],
        ["Address", profile.contact.address]
      ];

      rows.forEach(([labelText, valueText]) => {
        const row = document.createElement("div");
        row.className = "detail-row";

        const labelEl = document.createElement("div");
        labelEl.className = "detail-label";
        labelEl.textContent = labelText;

        const valueEl = document.createElement("div");
        valueEl.className = "detail-value";
        valueEl.textContent = valueText;

        row.appendChild(labelEl);
        row.appendChild(valueEl);
        contactBox.appendChild(row);
      });

      const orderTitle = document.createElement("div");
      orderTitle.className = "section-title";
      orderTitle.textContent = "Order Details";

      const orderBox = document.createElement("div");
      orderBox.className = "order-summary";

      const totalOrdersRow = document.createElement("div");
      totalOrdersRow.className = "detail-row";

      const totalOrdersLabel = document.createElement("div");
      totalOrdersLabel.className = "detail-label";
      totalOrdersLabel.textContent = "Total Orders";

      const totalOrdersValue = document.createElement("div");
      totalOrdersValue.className = "detail-value";
      totalOrdersValue.textContent = profile.orders.length;

      totalOrdersRow.appendChild(totalOrdersLabel);
      totalOrdersRow.appendChild(totalOrdersValue);
      orderBox.appendChild(totalOrdersRow);

      const lastOrderRow = document.createElement("div");
      lastOrderRow.className = "detail-row";

      const lastOrderLabel = document.createElement("div");
      lastOrderLabel.className = "detail-label";
      lastOrderLabel.textContent = "Last Order";

      const lastOrderValue = document.createElement("div");
      lastOrderValue.className = "detail-value";
      if (profile.orders.length > 0) {
        const lastOrder = profile.orders[0];
        lastOrderValue.textContent = `${lastOrder.id} • ${lastOrder.date}`;
      } else {
        lastOrderValue.textContent = "No orders yet";
      }

      lastOrderRow.appendChild(lastOrderLabel);
      lastOrderRow.appendChild(lastOrderValue);
      orderBox.appendChild(lastOrderRow);

      const orderActions = document.createElement("div");
      orderActions.className = "order-actions";

      const statusChip = document.createElement("div");
      statusChip.className = "order-status-chip";
      if (profile.orders.length > 0) {
        statusChip.textContent = `Latest: ${profile.orders[0].status}`;
      } else {
        statusChip.textContent = "No recent orders";
      }

      const toggleBtn = document.createElement("button");
      toggleBtn.className = "toggle-orders-btn";
      toggleBtn.type = "button";
      toggleBtn.textContent = "View Orders";

      const ordersList = document.createElement("div");
      ordersList.className = "orders-list";

      if (profile.orders.length > 0) {
        profile.orders.forEach(order => {
          const item = document.createElement("div");
          item.className = "order-item";

          const id = document.createElement("div");
          id.className = "order-id";
          id.textContent = order.id;

          const meta = document.createElement("div");
          meta.className = "order-meta";
          meta.textContent = `${order.date} • ${order.total} • ${order.status}`;

          item.appendChild(id);
          item.appendChild(meta);
          ordersList.appendChild(item);
        });
      } else {
        const emptyOrders = document.createElement("div");
        emptyOrders.style.fontSize = "0.85rem";
        emptyOrders.style.color = "#9ca3af";
        emptyOrders.textContent = "This user has no previous orders.";
        ordersList.appendChild(emptyOrders);
      }

      toggleBtn.addEventListener("click", () => {
        const isVisible = ordersList.style.display === "block";
        ordersList.style.display = isVisible ? "none" : "block";
        toggleBtn.textContent = isVisible ? "View Orders" : "Hide Orders";
      });

      orderActions.appendChild(statusChip);
      orderActions.appendChild(toggleBtn);

      orderBox.appendChild(orderActions);
      orderBox.appendChild(ordersList);

      card.appendChild(header);
      card.appendChild(contactTitle);
      card.appendChild(contactBox);
      card.appendChild(orderTitle);
      card.appendChild(orderBox);

      return card;
    }

    function renderProfile() {
      const container = document.getElementById("profileContainer");
      const card = createProfileCard(userProfile);
      container.appendChild(card);
    }

    document.addEventListener("DOMContentLoaded", renderProfile);
  </script>
</body>
</html>
