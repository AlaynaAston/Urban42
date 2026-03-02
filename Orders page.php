<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Orders — Urban 42</title> <!--text/title shown in the browser tab-->
  <link rel="stylesheet" href="Orderspagestyle.css" /> <!--connects the CSS file-->
  
  <!-- Chatbox Styles -->
  <link rel="stylesheet" href="chatbox.css">
</head>
<body>
  <div class="navbar"> <!--main navigation bar container-->
  <div class="nav-left"> <!--left side of the navigation bar-->
    <div class="sidebar-icon">  <!--button that users will click to open the side menu-->
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
    <a href="#">Help</a> <!--link to the help page-->
    <a href="#">Log in</a> <!--link to the login page-->
    <a><form class="search-form"> <!--the search bar form-->
      <input type="text" placeholder="Search..." name="search"> <!--box where the user types what they want to search-->
      <button type="submit">🔍</button> <!--button that user clicks to start the searching-->
    </form></a>
    <a href="#">Cart</a> <!--link that takes user to the shopping cart-->
    </div>
  </div> <!--end of the navigation bar-->

  <div class="orders-section"> <!--main section that contains order related content-->
    <section id="wishlist"> <!--wishlist section-->
      <h2>My Wishlist</h2> <!--heading of the wishlist section-->
      <div class="wishlist-grid"> <!--grid layout for the wishlist items-->
        <div class="wishlist-card"> <!--one wishlist item-->
          <p><strong>Urban Hoodie</strong></p> <!--shows name of the item-->
          <button>Add to Cart</button> <!--button to add the item to the cart-->
        </div>
        <div class="wishlist-card"> <!--second wishlist item-->
          <p><strong>Denim Jacket</strong></p> <!--name of the item-->
          <button>Add to Cart</button> <!--button to add the item to the cart-->
        </div>
        <div class="wishlist-card"> <!--thired wishlist item-->
          <p><strong>Leather Boots</strong></p> <!--name of the item-->
          <button>Add to Cart</button> <!--button to add the item to the cart-->
        </div>
      </div>
    </section>

    <section id="current-orders"> <!--section for current orders-->
      <h2>Current Orders</h2> <!--displays title of the section-->
      <table> <!--creats a table to show current orders-->
        <tr> <!--table header row-->
          <th>Order ID</th> <!--title of the column-->
          <th>Date</th>
          <th>Items</th>
          <th>Status</th>
          <th>Tracking</th>
        </tr>
        <tr> <!--first order row-->
          <td>#U42-12345</td> <!--order ID-->
          <td>15 Nov 2025</td> <!--order's date-->
          <td>Urban Hoodie, Sneakers</td> <!--items in the order-->
          <td>Shipped</td> <!--order status-->
          <td><a href="#">Track Order</a></td> <!--link totrack the order-->
        </tr>
        <tr> <!--second order row-->
          <td>#U42-12346</td>
          <td>27 Nov 2025</td>
          <td>Denim Jacket</td>
          <td>Processing</td>
          <td><a href="#">Track Order</a></td>
        </tr>
      </table>
    </section>

    <section id="previous-orders"> <!--section for past orders-->
      <h2>Previous Orders</h2> <!--heading of this section-->
      <table> <!--table showing previous orders-->
        <tr> <!--header row-->
          <th>Order ID</th> <!--title of the column-->
          <th>Date</th>
          <th>Items</th>
          <th>Status</th>
        </tr>
        <tr> <!--first previous order row-->
          <td>#U42-12200</td>
          <td>05 Oct 2025</td>
          <td>Graphic Tee</td>
          <td>Delivered</td>
        </tr>
        <tr> <!--second previous order-->
          <td>#U42-12150</td>
          <td>15 Sep 2025</td>
          <td>Leather Boots</td>
          <td>Delivered</td>
        </tr>
      </table>
    </section>

    <section id="tracking"> <!--section to track an order-->
      <h2>Track an Order</h2> <!--heading of the section-->
      <form> <!--form that users will use to track an order-->
        <label for="tracking-id">Enter Order ID:</label> <!--label for the tracking id box-->
        <input type="text" id="tracking-id" name="tracking-id" required> <!--text box to input tracking id-->
        <button type="submit">Track</button> <!--button to submit the tracking id and get the result-->
      </form>
    </section>

    <div class="return-form"> <!--container for returns form-->
    <section id="returns"> <!--section that holds the returns information and form-->
      <h2>Returns & Refunds</h2> <!--heading of th returns section-->
      <form> <!--form that user will use in order to request a return-->
        <label for="return-order-id">Order ID:</label> <!--label of the return order id-->
        <input type="text" id="return-order-id" name="return-order-id" required> <!--text box to input id of the order user wants to return-->

        <label for="reason">Reason for Return:</label> <!--label for the reason for return box-->
        <select id="reason" name="reason" required> <!--dropdown menu to choose reason of returning-->
          <option value="">Select</option>
          <option value="size">Wrong Size</option> <!--option for wrong size-->
          <option value="faulty">Faulty Item</option> <!--option for faulty item-->
          <option value="wrong-item">Wrong Item Sent</option> <!--option for wrong item received-->
          <option value="other">Other</option> <!--option for anythng else-->
        </select>

        <label for="details">Additional Details:</label> <!--label for additional details box-->
        <textarea id="details" name="details" rows="4"></textarea> <!--box to input any additional detail-->

        <button type="submit">Submit Request</button> <!--button to submit request-->
      </form>
    </section>
    </div>
  </div>

<!-- ================= CHATBOX ================= -->
<div class="u42-chat-system">

  <div class="u42-chat-toggle" onclick="toggleChat()">💬</div>

  <div class="u42-chatbox" id="chatbox">
    <div class="u42-chat-header">
      Urban 42 Support
      <span onclick="toggleChat()">✕</span>
    </div>

    <div class="u42-chat-messages" id="chatMessages"></div>

    <div class="u42-chat-input-area">
      <input type="text" id="chatInput" placeholder="Ask us something...">
      <button onclick="sendMessage()">Send</button>
    </div>
  </div>

</div>

<!-- Chatbox Script -->
<script src="chatbox.js"></script>

</body>
</html>