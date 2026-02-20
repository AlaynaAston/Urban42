let currentStep = 0;
let selectedCategory = "";
let selectedSubOption = "";

function toggleChat() {
  const chat = document.getElementById("chatbox");
  chat.style.display = chat.style.display === "flex" ? "none" : "flex";

  if (chat.style.display === "flex" && currentStep === 0) {
    startChat();
  }
}

function startChat() {
  currentStep = 1;
  const container = document.getElementById("chatMessages");
  container.innerHTML = "";

  appendBotMessage("Thank you for contacting Urban 42 support.<br>How can we help you today?");
  showMainOptions();
}

function showMainOptions() {
  const options = [
    "I have a question",
    "Where is my order?",
    "My item didn’t arrive",
    "Returns & Refunds",
    "Other issue"
  ];

  appendOptions(options, handleMainSelection);
}

function handleMainSelection(option) {
  selectedCategory = option;
  appendUserMessage(option);

  if (option === "Where is my order?") {
    showSubOptions([
      "Track my order",
      "Order delayed",
      "Order cancelled"
    ]);
  } else if (option === "My item didn’t arrive") {
    showSubOptions([
      "Missing item",
      "Wrong item received",
      "Damaged item"
    ]);
  } else if (option === "Returns & Refunds") {
    showSubOptions([
      "How to return",
      "Refund status",
      "Exchange item"
    ]);
  } else {
    showContactForm();
  }
}

function showSubOptions(subOptions) {
  appendBotMessage("Please select an option below:");
  appendOptions(subOptions, handleSubSelection);
}

function handleSubSelection(option) {
  selectedSubOption = option;
  appendUserMessage(option);
  showContactForm();
}

function showContactForm() {
  appendBotMessage("Please enter your email and describe your issue below:");

  const container = document.getElementById("chatMessages");

  const formDiv = document.createElement("div");
  formDiv.innerHTML = `
    <input type="email" id="supportEmail" placeholder="Your email address" style="width:100%; padding:8px; margin:5px 0;">
    <textarea id="supportMessage" placeholder="Describe your issue..." style="width:100%; padding:8px; margin:5px 0;" rows="3"></textarea>
    <button onclick="submitSupport()">Send</button>
  `;

  container.appendChild(formDiv);
  container.scrollTop = container.scrollHeight;
}

function submitSupport() {
  const email = document.getElementById("supportEmail").value.trim();
  const message = document.getElementById("supportMessage").value.trim();

  if (!email.includes("@")) {
    alert("Please enter a valid email address.");
    return;
  }

  if (message.length < 5) {
    alert("Please describe your issue.");
    return;
  }

  appendBotMessage("Thank you. Our support team will contact you shortly.");
}

function appendBotMessage(text) {
  const container = document.getElementById("chatMessages");
  const message = document.createElement("div");
  message.className = "chat-message bot-message";
  message.innerHTML = text;
  container.appendChild(message);
  container.scrollTop = container.scrollHeight;
}

function appendUserMessage(text) {
  const container = document.getElementById("chatMessages");
  const message = document.createElement("div");
  message.className = "chat-message user-message";
  message.innerHTML = text;
  container.appendChild(message);
  container.scrollTop = container.scrollHeight;
}

function appendOptions(options, callback) {
  const container = document.getElementById("chatMessages");

  const optionsDiv = document.createElement("div");
  optionsDiv.style.marginTop = "10px";

  options.forEach(option => {
    const btn = document.createElement("button");
    btn.innerText = option;
    btn.style.display = "block";
    btn.style.margin = "5px 0";
    btn.onclick = function () {
      optionsDiv.remove();
      callback(option);
    };
    optionsDiv.appendChild(btn);
  });

  container.appendChild(optionsDiv);
  container.scrollTop = container.scrollHeight;
}