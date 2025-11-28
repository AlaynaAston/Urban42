<?php
include 'database file';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $orderID   = $_POST['orderID'];
    $productID = $_POST['productID'];
    $quantity  = $_POST['quantity'];
    $itemPrice = $_POST['itemPrice'];

    
    $subtotal = $quantity * $itemPrice;

    
    $stmt = $conn->prepare("
        INSERT INTO purchases (orderID, productID, quantity, itemPrice, subtotal)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("iiidd", $orderID, $productID, $quantity, $itemPrice, $subtotal);

    if ($stmt->execute()) {
        echo "Purchase added.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>