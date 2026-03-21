<?php
session_start();
require 'db.php';

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

// ✅ Validate POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["membership"])) {
    header("Location: Profile.php");
    exit();
}

$userID = $_SESSION["userID"];
$membership = $_POST["membership"];

// ✅ Allow only valid values
$allowed = ["Standard", "Silver", "Gold"];
if (!in_array($membership, $allowed)) {
    die("Invalid membership selected.");
}

try {
    $stmt = $db->prepare("
        UPDATE Users
        SET membership = ?
        WHERE userID = ?
    ");

    $stmt->execute([$membership, $userID]);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// ✅ Redirect back (forces refresh)
header("Location: Profile.php");
exit();