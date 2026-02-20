function toggleChat() {
  const chat = document.getElementById("chatbox");
  chat.style.display = chat.style.display === "flex" ? "none" : "flex";
}

function sendMessage() {
  const input = document.getElementById("chatInput");
  const text = input.value.trim();
  if (text === "") return;

  appendMessage(text, "user-message");
  input.value = "";

  setTimeout(() => {
    showTyping();
  }, 500);
}

function appendMessage(text, type) {
  const container = document.getElementById("chatMessages");
  const message = document.createElement("div");
  message.className = "chat-message " + type;

  const time = new Date();
  const stamp = time.getHours().toString().padStart(2,"0") + ":" +
                time.getMinutes().toString().padStart(2,"0");

  message.innerHTML = text + `<span class="timestamp">${stamp}</span>`;
  container.appendChild(message);
  container.scrollTop = container.scrollHeight;
}

function showTyping() {
  const container = document.getElementById("chatMessages");
  const typing = document.createElement("div");
  typing.className = "chat-message bot-message";
  typing.innerText = "Support is typing...";
  container.appendChild(typing);
  container.scrollTop = container.scrollHeight;

  setTimeout(() => {
    typing.remove();
    appendMessage(generateReply(), "bot-message");
  }, 1200);
}

function generateReply() {
  const replies = [
    "We’re happy to help!",
    "Orders usually arrive within 3–5 days.",
    "You can view your orders in your profile.",
    "Feel free to ask anything else."
  ];
  return replies[Math.floor(Math.random() * replies.length)];
}
