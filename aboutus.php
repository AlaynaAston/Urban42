<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Urban 42 About</title>

    <!-- original page styles (unchanged) -->
    <style>
        :root {
            --bg: #f9f9f9;
            --text: #333;
            --heading: #222;
            --subheading: #222;
            --card-bg: #ffffff;
            --border: #030303;
            --input-border: #ccc;
            --button-bg: #222;
            --button-text: #fff;
            --border-color:#768fc5;
        }

        body.dark-mode {
            --bg: #121212;
            --text: #e5e5e5;
            --heading: #ffffff;
            --subheading: #ffffff;
            --card-bg: #1e1e1e;
            --border: #444;
            --input-border: #555;
            --button-bg: #ffffff;
            --button-text: #000000;
            --border-color:#203563;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: var(--text);
            background-color: var(--bg);
        }
        
        a {
            color: var(--text); /*sets text colour for links*/
            text-decoration: none; /*removes the underline from links*/
        }

        a:hover {
            text-decoration: underline; /*adds undeline when the mouse is over a link*/
        }
        .navbar {
            display: flex; /*places items in a row*/
            justify-content: space-between; /*spreads items to left and right*/
            align-items: center; /*centers items vertically*/
            padding: 15px 40px; /*space inside the navigation bar*/
            background-color: var(--card-bg); /*sets the background colour to white*/
            border-bottom: 2px solid var(--border); /*creates a black line under the navigation bar*/
            font-size: 14px; /*sets the text size in the navigation bar*/
        }

        .nav-left { 
            display: flex; /*places items in a row*/
            align-items: center; /*centers items vertically*/
            gap: 20px; /*space between items*/
        }

        .sidebar-icon {
            display: flex; /*shows the bars in a column*/
            flex-direction: column; /*stacks the bars (-) vertically*/
            gap: 5px; /*sets the space between each bar*/
            cursor: pointer; /*shows a pointer when hovering to make it look clickable*/
        }

        .sidebar-icon .bar {
            width: 25px; /*length of the each bar*/
            height: 3px; /*thickness of the each bar*/
            background-color: var(--text); /*sets dark grey as the bar colour*/
        }

        .brand-logo {
            display: flex; /*puts logo and text in a row*/
            align-items: center; /*centers them vertically*/
            gap: 10px; /*space between logo and text*/
            font-size: 18px; /*size of the brand name text*/
            font-weight: bold; /*makes the brand name bold*/
            color: var(--text); /*sets the text colour*/
        }

        .brand-logo img {
            width: 40px; /*sets the width of the brand logo image*/
            height: auto; /*keeps the image shape correct*/
        }

        .nav-right {
            display: flex; /*puts items in a row*/
            align-items: center; /*centers them vertically*/
            gap: 20px; /*space between each item*/
        }

        .flag-icon {
            width: 20px; /*size of the flag image*/
            height: auto; /*keeps the image shape correct*/
        }

        .search-form {
            display: flex; /*puts items in a row*/
            border: 1px solid var(--input-border); /*sets light grey border*/
            border-radius: 4px; /*creates slightly rounded corners*/
            overflow: hidden; /*keeps the corners clean and neat*/
        }

        .search-form input {
            padding: 8px 12px; /*spac inside the input box*/
            border: none; /*it removes the border of search bar*/
            outline: none; /*removes the outline when clicked*/
            font-size: 14px; /*sets the text size*/
        }

        .search-form button {
            background-color: #222; /*sets dark background for button*/
            color: var(--button-text); /*sets the text colour to white*/
            border: none; /*removes border*/
            padding: 8px 12px; /*adds space inside the button*/
            cursor: pointer; /*shows pointer when hovering*/
        }

        .sidebar {
            position: fixed;
            top: 70px;
            left: -350px; /* hides the side bar off-screen */
            width: 250px;
            height: 100%;
            background: var(--card-bg);
            border-right: 2px solid var(--border);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            transition: 0.3s ease; /* smooth slide animation */
        }

        /* When sidebar is open */
        .sidebar.open {
            left: 0;
        }

        .theme-toggle {
            background: none;
            border: 1px solid var(--border);
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            color: var(--text);
        }

        .chart-container {
            width: 80%;
            max-width: 700px;
            margin: 60px auto;
            padding: 30px;
            background: var(--card-bg);
            border-radius: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 0 12px rgba(0,0,0,0.08);
        }


        /* remaining original styles (unchanged) */

        header {
            background: var(--bg);
            padding: 20px;
            border-bottom: 2px solid var(--border-color);
        }

        .logo {
            font-size: 36px;
            font-weight: 900;
            color: var(--text);
            letter-spacing: 4px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        .image-box {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .image-box img {
            width: 100%;
            height: 380px;
            object-fit: cover;
            border: 3px solid var(--border);
        }

        .text-box {
            padding: 40px;
            border: 4px solid var(--text);
            border-radius: 20px;
            background: linear-gradient(to bottom right, var(--border-color) 0%, var(--bg) 100%);
        }

        h1 { font-size: 42px; margin-bottom: 15px; font-weight: 700; color: var(--heading); }
        h2 { font-size: 32px; margin-bottom: 20px; font-weight: 700; text-transform: uppercase; }
        h3 { font-size: 18px; font-weight: 700;}

        .line {
            height: 3px;
            background: linear-gradient(to right, var(--border-color), #3b82f6);
            margin: 20px 0;
        }

        p { margin-bottom: 20px; line-height: 1.8; font-size: 15px; color: var(--text);}

        .grey-section {
            background: linear-gradient(to bottom, var(--border-color) 0%, var(--bg) 100%);
            padding: 50px 20px;
            margin: 40px 0;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 40px;
        }

        .card {
            background: var(--card-bg);
            padding: 30px;
            border: 3px solid var(--border-color);
            text-align: center;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: var(--border-color);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2);
        }

        .policy-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .policy-box {
            background: linear-gradient(to bottom right, var(--border-color) 0%, var(--bg) 100%);
            padding: 25px;
            border-left: 5px solid var(--text);
        }

        .black-section {
            background: linear-gradient(135deg, #1e3a8a 0%, var(--border-color) 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .button {
            display: inline-block;
            background: var(--button-bg);
            color: var(--bg);
            padding: 15px 40px;
            margin: 20px 10px;
            text-decoration: none;
            font-weight: 700;
            border: 3px solid var(--border-color);
            transition: 0.3s;
            text-transform: uppercase;
        }
    </style>

    <!-- added: chatbox css -->
    <link rel="stylesheet" href="chatbox.css">

</head>

<body>

    <!-- NAVBAR (original, unchanged) -->
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
        <button id="theme-toggle" class="theme-toggle">🌙</button>
        <form class="search-form"> <!--the search bar form-->
        <input type="text" placeholder="Search..." name="search" class="nav-search"> <!--box where the user types what they want to search-->
        <button type="submit">🔍</button> <!--button that user clicks to start the searching-->
        </form>
        <a href="basket.html">Cart</a> <!--link that takes user to the shopping cart-->
    </div>
    </div> 
    <div id="sidebar" class="sidebar">
        <a href="Profile.php">Your Account</a>
        <a href="index.html">Home</a>
        <a href="aboutus.php">About Us</a>
        <a href="index.php">Shop</a>
        <a href="#">New Arrivals</a>
        <a href="#">Sale</a>
        <a href="ContactPage.php">Contact Us</a>
    </div><!--end of the navigation bar-->
    
    <!-- PAGE CONTENT (unchanged) -->
    <header>
        <div class="logo">URBAN 42</div>
    </header>

    <div class="container">
        <div class="about-grid">

            <div class="image-box">
                <img src="urban42.png" alt="Urban 42 logo">
            </div>

            <div class="text-box">
                <h1>ABOUT US</h1>
                <h2>MEET REAL STREETWEAR</h2>
                <div class="line"></div>
                <p>At urban 42 we redefine streetwear...</p>
                <p>We blend the edgy, vibrant energy...</p>
            </div>

        </div>
    </div>

    <div class="grey-section">
        <div class="container">
            <h2>OUR MISSION</h2>
            <div class="line"></div>
            <p>Our mission is to revolutionize urban fashion...</p>
        </div>
    </div>

    <div class="container">

        <h2>OUR VALUES</h2>
        <div class="line"></div>

        <div class="cards">
            <div class="card"><h3>Sustainable Materials</h3><p>We use organic cotton...</p></div>
            <div class="card"><h3>Fair Production</h3><p>Every factory partner...</p></div>
            <div class="card"><h3>Carbon Neutral</h3><p>Our supply chain...</p></div>
            <div class="card"><h3>Quality First</h3><p>We create timeless pieces...</p></div>
            <div class="card"><h3>Transparency</h3><p>Track your item...</p></div>
            <div class="card"><h3>Community Impact</h3><p>5% of profits...</p></div>
        </div>

        <h2 style="margin-top: 60px;">SHIPPING AND RETURNS</h2>
        <div class="line"></div>

        <div class="policy-grid">
            <div class="policy-box"><h3>Free Shipping</h3><p>Free shipping...</p></div>
            <div class="policy-box"><h3>30-Day Returns</h3><p>Return any item...</p></div>
            <div class="policy-box"><h3>Eco Packaging</h3><p>100% recyclable...</p></div>
            <div class="policy-box"><h3>Quality Guarantee</h3><p>2-year warranty...</p></div>
        </div>

    </div>
 <!--Bar charts of monthly sales and best selling products-->
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
    
    <div class="black-section">
        <h2>JOIN THE MOVEMENT</h2>
        <p>Be part of the sustainable streetwear revolution</p>
        <a href="#" class="button">SHOP COLLECTION</a>
    </div>

    <!-- ========================================= -->
    <!-- added: chatbox html -->
    <!-- ========================================= -->

    <div class="u42-chat-system">

        <!-- added: chatbox toggle -->
        <div class="u42-chat-toggle" onclick="toggleChat()">💬</div>

        <!-- added: chatbox container -->
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

    <!-- added: chatbox script -->
    <script src="chatbox.js"></script>
 <!-- ================= Sidebar functionality ================= -->
<script> 
    document.querySelector(".sidebar-icon").addEventListener("click", () => {
    document.getElementById("sidebar").classList.toggle("open");
    });
    document.addEventListener("click", (e) => {
    const sidebar = document.getElementById("sidebar");
    const icon = document.querySelector(".sidebar-icon");

  // If clicking outside the sidebar AND not clicking the icon
    if (!sidebar.contains(e.target) && !icon.contains(e.target)) {
      sidebar.classList.remove("open");
    }
  });
  </script>

<!-- ================= Theme toggle functionality ================= -->
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
</body>

</html>
