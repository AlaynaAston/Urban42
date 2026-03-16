<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["user_id"];

if (isset($_FILES["photo"])) {

    $file = $_FILES["photo"];

    if ($file["error"] === 0) {

        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);

        $newName = "profile_" . $userID . "." . $ext;

        $uploadPath = "uploads/" . $newName;

        move_uploaded_file($file["tmp_name"], $uploadPath);

        $stmt = $db->prepare("
            UPDATE Users
            SET profilePhoto = ?
            WHERE userID = ?
        ");

        $stmt->execute([$uploadPath, $userID]);

    }
}

header("Location: Profile.php");
exit();