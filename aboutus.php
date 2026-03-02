<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Urban 42 About</title>

    <!-- original page styles (unchanged) -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
        }
        
        a { color: #333; text-decoration: none; }
        a:hover { text-decoration: underline; }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 40px;
            background-color: #fff;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .sidebar-icon {
            display: flex;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .sidebar-icon .bar {
            width: 25px;
            height: 3px;
            background-color: #333;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #222;
        }

        .brand-logo img {
            width: 40px;
            height: auto;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .flag-icon {
            width: 20px;
            height: auto;
        }

        .search-form {
            display: flex;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow: hidden;
        }

        .search-form input {
            padding: 8px 12px;
            border: none;
            outline: none;
            font-size: 14px;
        }

        .search-form button {
            background-color: #222;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        /* remaining original styles (unchanged) */

        header {
            background: #f8f8f8;
            padding: 20px;
            border-bottom: 2px solid #2563eb;
        }

        .logo {
            font-size: 36px;
            font-weight: 900;
            color: #333;
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
            border: 3px solid #2563eb;
        }

        .text-box {
            padding: 40px;
            border: 4px solid #2563eb;
            border-radius: 20px;
            background: linear-gradient(to bottom right, #fff 0%, #eff6ff 100%);
        }

        h1 { font-size: 42px; margin-bottom: 15px; font-weight: 700; }
        h2 { font-size: 32px; margin-bottom: 20px; font-weight: 700; text-transform: uppercase; }
        h3 { font-size: 18px; font-weight: 700; }

        .line {
            height: 3px;
            background: linear-gradient(to right, #2563eb, #3b82f6);
            margin: 20px 0;
        }

        p { margin-bottom: 20px; line-height: 1.8; font-size: 15px; }

        .grey-section {
            background: linear-gradient(to bottom, #eff6ff 0%, #dbeafe 100%);
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
            background: white;
            padding: 30px;
            border: 3px solid #3b82f6;
            text-align: center;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: #2563eb;
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2);
        }

        .policy-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .policy-box {
            background: #eff6ff;
            padding: 25px;
            border-left: 5px solid #2563eb;
        }

        .black-section {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .button {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 15px 40px;
            margin: 20px 10px;
            text-decoration: none;
            font-weight: 700;
            border: 3px solid #2563eb;
            transition: 0.3s;
            text-transform: uppercase;
        }
    </style>

    <!-- added: chatbox css -->
    <link rel="stylesheet" href="chatbox.css">

</head>

<body>

    <!-- NAVBAR (original, unchanged) -->
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

            <form class="search-form">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit">🔍</button>
            </form>

            <a href="basket.html">Cart</a>
        </div>
    </div>

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

</body>
</html>