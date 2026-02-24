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
    <a href="#">Help</a> <!--link to the help page-->
    <a href="#">Log in</a> <!--link to the login page-->
    <button id="theme-toggle" class="theme-toggle">🌙</button>
      <form class="search-form"> <!--the search bar form-->
      <input type="text" placeholder="Search..." name="search"> <!--box where the user types what they want to search-->
      <button type="submit">🔍</button> <!--button that user clicks to start the searching-->
    </form>
    <a href="#">Cart</a> <!--link that takes user to the shopping cart-->
    </div>
  </div> <!--end of the navigation bar-->
      <div id="sidebar" class="sidebar">
  <a href="#">Home</a>
  <a href="#">Shop</a>
  <a href="#">New Arrivals</a>
  <a href="#">Sale</a>
  <a href="#">Contact</a>
</div>
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

  <script>
    document.querySelector(".sidebar-icon").addEventListener("click", () => { //when the menu icon is clicked open or close the sidebar.
    document.getElementById("sidebar").classList.toggle("open");
    });
    document.addEventListener("click", (e) => { //it closes the sidebar when anywhere else on the page is clicked.
    const sidebar = document.getElementById("sidebar");
    const icon = document.querySelector(".sidebar-icon");

    if (!sidebar.contains(e.target) && !icon.contains(e.target)) { //it makes sure the sidebar only closes when the click is not inside the sidebar.
      sidebar.classList.remove("open"); //closes the sidebar
    }
  });
  </script>

  <script>
  const toggleBtn = document.getElementById("theme-toggle");

  if (localStorage.getItem("theme") === "dark") { //this checks if the user previously chose dark mode. If yes, it turns dark mode back on when the page loads.
    document.body.classList.add("dark-mode"); //turns the dark mode on.
    toggleBtn.textContent = "☀️"; //shows the button with sun icon.
  }

  toggleBtn.addEventListener("click", () => {  //this runs when the user clicks dark mode button which is moon icon.
    document.body.classList.toggle("dark-mode"); //makes the theme switch between dark mode and light mode.

    const isDark = document.body.classList.contains("dark-mode"); //checks if dark mode is currently active.
    toggleBtn.textContent = isDark ? "☀️" : "🌙"; //changes the icon on button depending on the mode. Sun means dark mode is on and Moon means light mode is on.

    localStorage.setItem("theme", isDark ? "dark" : "light"); //it saves the user's choice so the website remembers it next time.
  });
</script>

<div class="chart-container"> <!--this container holds the first bar chart which is Monthly Sales-->
  <canvas id="monthlySalesChart"></canvas> <!--the <canvas> element is where Chart.js draws the chart.-->
</div>

<div class="chart-container"> <!--this container holds the second bar chart which is Best‑Selling Categories-->
  <canvas id="categoryChart"></canvas> <!--here canvas is used again for the second chart as each chart needs it own <canvas> element with a unique id-->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!--this loads the Chart.js library from an online CDN. Chart.js is the JavaScript library used to create the bar charts on the website. -->

<script>
function textColor() {
  return getComputedStyle(document.body).getPropertyValue('--text');
} //this fuction gets the text colour from CSS file so it makes sure the chart text changes correctly according to the selected mode.
function isDarkMode() {
  return document.body.classList.contains("dark-mode");
}
/*Chart 1: MONTHLY SALES CHART*/
function createMonthlySalesChart() {
  const ctx1 = document.getElementById('monthlySalesChart'); //this finds the canvas element where the monthly sales chart will be drawn

  return new Chart(ctx1, { //it creates a new bar chart using Chart.js.
    type: 'bar', //states that this chart is a bar chart.
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], //These are the labels along the bottom of the chart.
      datasets: [{ //the data that will be shown as bars
        label: 'Monthly Sales (£)',
        data: [1700, 2500, 1500, 2000, 2600, 1200], //sales numbers
         backgroundColor: function(context) {
          const chart = context.chart; //it gets the chart that is currently being drawn.
          const {ctx, chartArea} = chart; //it gets the drawing tool(ctx) and the chart's size.

          if (!chartArea) return null; //if the chart isn’t fully ready yet, it stops here to avoid errors.

          const gradient = ctx.createLinearGradient( //it creates a vertical gradient from top to bottom of the chart.
            0,
            chartArea.top,
            0,
            chartArea.bottom
          );

          if (isDarkMode()) { //it applies different gradient colours depending on the theme.
            gradient.addColorStop(0, "#ffffff"); //sets the top colour in dark mode
            gradient.addColorStop(1, "#777777"); //sets the bottom colour in dark mode
          } else {
            gradient.addColorStop(0, "#111111"); //sets the top colour in light mode
            gradient.addColorStop(1, "#777777"); //sets the bottom colour in light mode
          }

          return gradient; //returns the finished gradient so Chart.js can use it as the bar colour.
        },

        borderRadius: 8 //it rounds the corners of each bar.
      }]
    },
    
    options: {
      responsive: true, //this makes the chart resize on different screens.
      plugins: {
        title: { //adds the title above the chart.
          display: true,
          text: 'Urban 42 — Monthly Sales Overview',
          color: textColor(), //makes the title match dark or light mode.
          font: {size: 20, weight: 'bold'} //sets the text size to 20 and makes it bold.
        },
        legend: { //it styles the legend.
          labels: {color: textColor()}
        }
      },
      scales: { //it controls the X and Y axes
        x: {
          ticks: {color: textColor()}, //sets the text colour of X-axis
          grid: {display: false} //removes the vertical grid lines
        },
        y: {
          beginAtZero: true, //makes the Y-Axis start at 0.
          ticks: {color: textColor()}, //sets the text colour of Y-axis.
          grid: {color: 'rgba(150,150,150,0.2)'} //sets the colour of grid lines to light grey.
        }
      }
    }
  });
}

//Chart 2: BEST-SELLING PRODUCTS SALES CHART
function createCategoryChart() { //this finds the canvas element where the second chart will be drawn
  const ctx2 = document.getElementById('categoryChart');

  return new Chart(ctx2, { //creates the chart
    type: 'bar', //sets the type of chart which is bar here.
    data: {
      labels: ['Hoodies', 'Shirts/Tops', 'Jeans', 'Shoes', 'Accessories'], //the product categories that are shown at the bottom.
      datasets: [{
        label: 'Units Sold', //label shown in the legend
        data: [570, 380, 310, 260, 190], //these are the sales numbers for each category
        backgroundColor: ['#222', '#444', '#666', '#888', '#aaa'], //sets the bar colours
        borderRadius: 8 //makes the bar corners round
      }]
    },
    options: {
      responsive: true, // makes the chart resize on different screens.
      plugins: {
        title: { //adds the title above the chart.
          display: true,
          text: 'Urban 42 — Best-Selling Product Categories',
          color: textColor(), //sets the colour of the text
          font: {size: 20, weight: 'bold'} //sets the text size to 20 and makes it bold.
        },
        legend: { //styles the legend.
          labels: {color: textColor()} //sets the labels colour.
        }
      },
      scales: { //it controls the X and Y axes
        x: {
          ticks: {color: textColor()}, //sets the text colour of X-axis
          grid: {display: false} //removes the vertical grid lines
        },
        y: {
          beginAtZero: true, //makes the Y-Axis start at 0.
          ticks: {color: textColor()}, //sets the text colour of Y-axis
          grid: {color: 'rgba(150,150,150,0.2)'} //sets the colour of grid lines to light grey.
        }
      }
    }
  });
}

let monthlyChart = createMonthlySalesChart(); //creates monthly sales chart when the page loads.
let categoryChart = createCategoryChart(); //creates best selling category chart when the page loads.

//when the mode changes from light to dark or dark to light.
document.getElementById("theme-toggle").addEventListener("click", () => {
  setTimeout(() => { //it makes the browser wait briefly to allow the theme to change.
    monthlyChart.destroy(); //removes the old monthly sales chart that have colours before changing the theme/mode.
    categoryChart.destroy(); //removes the old best selling category chart that have colours before changing the theme/mode.
    monthlyChart = createMonthlySalesChart(); //recreates monthly sales chart with the updated colours.
    categoryChart = createCategoryChart(); //recreates best selling product category chart with the updated colours.
  }, 300); //here 300 is used so browser gets enough time to switch the theme. it is basically 300 milliseconds which short enough that user doesn't notice and long enough for the theme to fully update.
});
</script>
</body>
</html>
