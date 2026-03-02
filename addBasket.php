<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST["productID"])) {
    die("No product selected.");
}

$userID = $_SESSION["user_id"];
$productID = $_POST["productID"];

/* Check if product already in basket */
$check = $db->prepare("
  SELECT basketItemID, quantity
  FROM BasketItem
  WHERE userID = ? AND productID = ?
");
$check->execute([$userID, $productID]);
$item = $check->fetch(PDO::FETCH_ASSOC);

if ($item) {
    // Update quantity
    $update = $db->prepare("
      UPDATE BasketItem
      SET quantity = quantity + 1
      WHERE basketItemID = ?
    ");
    $update->execute([$item["basketItemID"]]);
} else {
    // Insert new row
    $insert = $db->prepare("
      INSERT INTO BasketItem (userID, productID, quantity)
      VALUES (?, ?, 1)
    ");
    $insert->execute([$userID, $productID]);
}

header("Location: basket.php");
exit();
?>