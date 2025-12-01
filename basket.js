// Load saved basket when page opens
window.onload = function () {
  loadBasket();
  updateTotal();
};

// Save quantities to localStorage
function saveBasket() {
  let basket = [];

  document.querySelectorAll(".basket-item").forEach(item => {
    const name = item.querySelector("span").innerText.trim();
    const price = item.querySelector(".price").dataset.price;
    const qty = item.querySelector(".qty").value;

    basket.push({
      name: name,
      price: price,
      qty: qty
    });
  });

  localStorage.setItem("basket", JSON.stringify(basket));
}

// Load basket from localStorage
function loadBasket() {
  const savedBasket = JSON.parse(localStorage.getItem("basket"));

  if (!savedBasket) return;

  const items = document.querySelectorAll(".basket-item");

  items.forEach((item, index) => {
    if (savedBasket[index]) {
      item.querySelector(".qty").value = savedBasket[index].qty;
    }
  });
}

// Update total price
function updateTotal() {
  let total = 0;

  document.querySelectorAll(".basket-item").forEach(item => {
    const price = parseFloat(item.querySelector(".price").dataset.price);
    const qty = parseInt(item.querySelector(".qty").value) || 0;

    total += price * qty;
  });

  document.getElementById("total").innerText = total.toFixed(2);

  // Save every time it updates
  saveBasket();
}

// Listen for quantity changes
document.querySelectorAll(".qty").forEach(qtyInput => {
  qtyInput.addEventListener("input", updateTotal);
});
