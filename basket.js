// Load saved basket when page opens
window.onload = function () {
  loadBasket();
  updateTotal();
};

// Save quantities
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

  localStorage.setItem("urban42_basket", JSON.stringify(basket));
}

// Load basket
function loadBasket() {
  const savedBasket = JSON.parse(localStorage.getItem("urban42_basket"));
  if (!savedBasket) return;

  const items = document.querySelectorAll(".basket-item");

  items.forEach((item, index) => {
    if (savedBasket[index]) {
      item.querySelector(".qty").value = savedBasket[index].qty;
    }
  });
}

// Update total
function updateTotal() {
  let total = 0;

  document.querySelectorAll(".basket-item").forEach(item => {
    const price = parseFloat(item.querySelector(".price").dataset.price);
    const qty = parseInt(item.querySelector(".qty").value) || 0;
    total += price * qty;
  });

  document.getElementById("total").innerText = total.toFixed(2);
  saveBasket();
}

function proceedToCheckout() {
  let total = parseFloat(document.getElementById("total").innerText);

  if (total === 0) {
    alert("Your basket is currently empty.");
  } else {
    window.location.href = "checkout.php";
  }
}

// Listen for quantity change
document.querySelectorAll(".qty").forEach(qtyInput => {
  qtyInput.addEventListener("input", updateTotal);
});
