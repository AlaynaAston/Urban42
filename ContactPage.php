<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact & Help — Urban 42</title> <!--text/title shown in the browser tab-->
  <link rel="stylesheet" href="Contactpagestyle.css" /> <!--connects the CSS file-->
</head>
<body>
  <div class="navbar"> <!--main navigation bar container-->
  <div class="nav-left"> <!--left side of the navigation bar-->
    <div class="sidebar-icon"> <!--button that users will click to open the side menu-->
      <span class="bar"></span> <!--horizontal line 1 that creates the button-->
      <span class="bar"></span> <!--line 2-->
      <span class="bar"></span> <!--line 3-->
    </div>
    <div class="brand-logo"> <!--container that has logo and brand name in it-->
      <img src="urban42.png" alt="Urban 42 Logo"> <!--shows the brand logo-->
      <span>Urban 42</span> <!--displays the brand name-->
    </div>
  </div>
  <div class="nav-right"> <!--right side of the navigation bar-->
    <img src="ukflag.jpg" alt="UK Flag" class="flag-icon"> <!--shows a UK flag icon-->
    <span>GBP £</span> <!--shows the currency-->
    <a href="ContactPage.php">Help</a> <!--link to the help page-->
    <a href="login.html">Log in</a> <!--link to the login page-->
    <a><form class="search-form"> <!--the search bar form-->
      <input type="text" placeholder="Search..." name="search"> <!--box where the user types what they want to search-->
      <button type="submit">🔍</button>  <!--button that user clicks to start the searching-->
    </form></a>
    <a href="basket.html">Cart</a> <!--link that takes user to the shopping cart-->
    </div>
  </div> <!--end of the navigation bar-->

  <div class="container"> <!--container that holds the main content-->
    <div class="logo-section"> <!--section that holds the logo and contact details-->
      <img src="urban42.png" alt="Urban 42 Logo"> <!--shows the brand logo-->
      <div class="contact-info"> <!--area that contains the contact information-->
        <b>Customer Service Line:</b> +44 20 637 7921<br> <!--phone number-->
        Available Monday–Friday, 9am–6pm GMT<br><br> <!--opening hours informatiom-->

        <b>Email Contacts:</b><br> <!--heading for emails list-->
        General: support@urban42.co.uk<br> <!--general support email-->
        Returns: returns@urban42.co.uk<br> <!--returns email-->
        Technical: tech@urban42.co.uk<br><br> <!--technical support email-->

        <b>Social Media:</b><br> <!--heading for social media links-->
        Instagram: <a href="#">urban42official</a><br> <!--link for instagram profile-->
        Facebook: <a href="#">urban42UK</a><br> <!--facebook link-->
        TikTok: <a href="#">urban42</a> <!--tiktok link-->
      </div>
    </div>

    <div class="contact-form"> <!--section that contains the contact form-->
      <h2>    CONTACT US </h2> <!--title of the form-->
      <p>We’d love to hear from you!</p> <!--short message for the user-->

      <form> <!--form that users will use to send message/queries-->
        <label for="name">Full Name*</label> <!--label for the name box-->
        <input type="text" id="name" name="name" required> <!--box where user types the full name-->

        <label for="email">Email Address*</label> <!--label for email box-->
        <input type="email" id="email" name="email" required> <!--box to input email-->

        <label for="type">Request Type*</label> <!--label for the dropdown menu-->
        <select id="type" name="type" required> <!--dropdown menu to choose request type-->
          <option value="">Select</option>
          <option value="order">Order Issue</option> <!--option for order problems-->
          <option value="returns">Returns & Refunds</option> <!--option for returns-->
          <option value="product">Product Inquiry</option> <!--option for questions related to products-->
          <option value="technical">Technical Support</option> <!--option for technical help-->
          <option value="other">Other</option> <!--option for anything else-->
        </select>
        <br> <!--break-->
        <label for="message">Message*</label> <!--label for the message box-->
        <textarea id="message" name="message" rows="5" required></textarea> <!--box to type the message-->

        <button type="submit">Submit Request</button> <!--button to submit the form-->
      </form>

      <p class="faq"> <!--a short line message under the form-->
        If you have any questions, please consult our FAQ. If you can't find the answer you're looking for, our team will be happy to help.
      </p>
    </div>
  </div>

  <div class="container"> <!--container for the FAQ section-->
    <div class="faq-section"> <!--section that has all the questions-->
      <h2>Frequently Asked Questions</h2> <!--heading of the section-->

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
