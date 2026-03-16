<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["user_id"];
$membership = $_POST["membership"];

$stmt = $db->prepare("
    UPDATE Users
    SET membership = ?
    WHERE userID = ?
");

$stmt->execute([$membership, $userID]);

header("Location: Profile.php");
exit();