// ===============================
// Urban42 Shopping Assistant Bot
// ===============================

function toggleChat() {
    const chat = document.getElementById("chatbox");
    chat.style.display = (chat.style.display === "flex") ? "none" : "flex";

    if (chat.style.display === "flex" && !chat.dataset.loaded) {
        chat.dataset.loaded = true;
        startChat();
    }
}

function startChat() {
    appendBot("Welcome to the Urban42 Shopping Assistant! 🛍️<br>How can I help you today?");
    showMainOptions();
}

// MAIN MENU OPTIONS
function showMainOptions() {
    const options = [
        "Find a product",
        "Help choosing a size",
        "Show current offers",
        "What's popular right now?",
        "Take me to a page"
    ];
    appendOptions(options, handleMainOption);
}

function handleMainOption(option) {
    appendUser(option);

    if (option === "Find a product") showProductCategories();
    if (option === "Help choosing a size") showSizeHelp();
    if (option === "Show current offers") showOffers();
    if (option === "What's popular right now?") showPopularItems();
    if (option === "Take me to a page") showPageLinks();
}

// PRODUCT CATEGORY SELECTOR
function showProductCategories() {
    appendBot("What type of product are you looking for?");
    appendOptions(["Hoodies", "Jeans", "Shoes", "Hats"], function (choice) {
        appendUser(choice);
        appendBot(`Great choice! Here you go:<br><a href="products.php" style="color:#1976D2">View ${choice}</a>`);
    });
}

// SIZE HELP
function showSizeHelp() {
    appendBot("Which item do you want size help with?");
    appendOptions(["Hoodie", "T-Shirt", "Shoes"], function (choice) {
        appendUser(choice);
        appendBot(`You can find full sizing here:<br><a href="size-chart.php" style="color:#1976D2">Urban42 Size Chart</a>`);
    });
}

// OFFERS
function showOffers() {
    appendBot(`
        🎉 <b>Current Urban42 Offers</b><br><br>
        ✔ 10% OFF for new customers<br>
        ✔ Free UK shipping over £50<br>
        ✔ Student discount 15% (coming soon)<br>
    `);
}

// POPULAR ITEMS
function showPopularItems() {
    appendBot(`
        🔥 <b>Popular Items Right Now</b><br><br>
        • Urban Hoodie<br>
        • Hi-Top Trainers<br>
        • Graphic Tees<br><br>
        <a href="products.php" style="color:#1976D2">Browse trending products</a>
    `);
}

// QUICK NAVIGATION
function showPageLinks() {
    appendBot("Which page would you like to go to?");
    appendOptions([
        "Home",
        "Products",
        "Contact Page",
        "About Us",
        "Basket",
        "Size Guide",
        "Orders"
    ], function (page) {
        appendUser(page);

        const links = {
            "Home": "index.php",
            "Products": "products.php",
            "Contact Page": "ContactPage.php",
            "About Us": "aboutus.php",
            "Basket": "basket.html",
            "Size Guide": "size-chart.php",
            "Orders": "Orders page.php"
        };

        appendBot(`Here you go:<br><a href="${links[page]}" style="color:#1976D2">Open ${page}</a>`);
    });
}

// ===============================
// REUSABLE MESSAGE + BUTTON UI
// ===============================

function appendBot(text) {
    const box = document.getElementById("chatMessages");
    const div = document.createElement("div");
    div.className = "u42-chat-message bot-message";
    div.innerHTML = text;
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
}

function appendUser(text) {
    const box = document.getElementById("chatMessages");
    const div = document.createElement("div");
    div.className = "u42-chat-message user-message";
    div.innerHTML = text;
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
}

function appendOptions(options, callback) {
    const box = document.getElementById("chatMessages");
    const wrapper = document.createElement("div");
    wrapper.className = "u42-option-wrapper";

    options.forEach(opt => {
        const btn = document.createElement("button");
        btn.className = "u42-option-button";
        btn.innerText = opt;
        btn.onclick = () => {
            wrapper.remove();
            callback(opt);
        };
        wrapper.appendChild(btn);
    });

    box.appendChild(wrapper);
    box.scrollTop = box.scrollHeight;
}