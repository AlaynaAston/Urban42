<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullName = trim($_POST["fullName"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm_password"]);
    $phone = trim($_POST["phone"]);
    $title = trim($_POST["title"]);
    $dob = $_POST["dob"];

    // Validation
    if (empty($email) || empty($password) || empty($confirm)) {
        exit("Please fill required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Invalid email.");
    }

    if (strlen($password) < 8) {
        exit("Password must be at least 8 characters.");
    }

    if ($password !== $confirm) {
        exit("Passwords do not match.");
    }

    // Check existing email
    $check = $db->prepare("SELECT userID FROM Users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        exit("Email already registered.");
    }

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $insert = $db->prepare("
        INSERT INTO Users (fullName, email, passwordHash, phone, title, dob)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $insert->execute([
        $fullName ?: null,
        $email,
        $passwordHash,
        $phone ?: null,
        $title ?: null,
        $dob ?: null
    ]);

    $_SESSION["user_id"] = $db->lastInsertId();
    $_SESSION["user_email"] = $email;

    header("Location: dashboard.php");
    exit();
}
?>