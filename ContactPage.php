<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact & Help — Urban 42</title>
  <link rel="stylesheet" href="Contactpagestyle.css" />
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
    </div>
  </div>

  <div class="container">

    <div class="logo-section">
      <img src="urban42.png" alt="Urban 42 Logo">
      <div class="contact-info">
        <b>Customer Service Line:</b> +44 20 637 7921<br>
        Available Monday–Friday, 9am–6pm GMT<br><br>

        <b>Email Contacts:</b><br>
        General: support@urban42.co.uk<br>
        Returns: returns@urban42.co.uk<br>
        Technical: tech@urban42.co.uk<br><br>

        <b>Social Media:</b><br>
        Instagram: <a href="#">urban42official</a><br>
        Facebook: <a href="#">urban42UK</a><br>
        TikTok: <a href="#">urban42</a>
      </div>
    </div>

    <div class="contact-form">
      <h2>    CONTACT US </h2>
      <p>We’d love to hear from you!</p>

      <form>
        <label for="name">Full Name*</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email Address*</label>
        <input type="email" id="email" name="email" required>

        <label for="type">Request Type*</label>
        <select id="type" name="type" required>
          <option value="">Select</option>
          <option value="order">Order Issue</option>
          <option value="returns">Returns & Refunds</option>
          <option value="product">Product Inquiry</option>
          <option value="technical">Technical Support</option>
          <option value="other">Other</option>
        </select>
        <br>
        <label for="message">Message*</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Submit Request</button>
      </form>

      <p class="faq">
        If you have any questions, please consult our FAQ. If you can't find the answer you're looking for, our team will be happy to help.
      </p>
    </div>
  </div>

  <div class="container">
    <div class="faq-section">
      <h2>Frequently Asked Questions</h2>

      <h3>1. Where is my order?</h3>
      <p>You can track your order using the tracking link sent to your email. If you haven’t received it, contact us with your order number.</p>

      <h3>2. How do I return an item?</h3>
      <p>Visit our Returns page and follow the instructions. You’ll need your order number and email address to start the return process.</p>

      <h3>3. When will I receive my refund?</h3>
      <p>Refunds are processed within 5–7 business days after we receive your returned item.</p>

      <h3>4. Can I change or cancel my order?</h3>
      <p>Orders can only be changed or canceled within 1 hour of placing them. Please contact us immediately if you need to make changes.</p>

      <h3>5. Do you ship internationally?</h3>
      <p>Yes, we ship to selected countries. Shipping options and costs will be shown at checkout based on your location.</p>

      <h3>6. What if I received a faulty or wrong item?</h3>
      <p>We’re sorry! Please contact us with your order number and a photo of the item. We’ll resolve it as quickly as possible.</p>
    </div>
  </div>

</body>
</html>