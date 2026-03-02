<?php
session_start();
require 'db.php';

if (!isset($_SESSION["login_attempts"])) {
    $_SESSION["login_attempts"] = 0;
}

if ($_SESSION["login_attempts"] > 5) {
    exit("Too many attempts. Try later.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        exit("Enter email and password.");
    }

    $stmt = $db->prepare("
        SELECT userID, passwordHash 
        FROM Users 
        WHERE email = ?
    ");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["passwordHash"])) {

        $_SESSION["login_attempts"] = 0;
        $_SESSION["user_id"] = $user["userID"];
        $_SESSION["user_email"] = $email;

        header("Location: dashboard.php");
        exit();

    } else {
        $_SESSION["login_attempts"]++;
        exit("Invalid email or password.");
    }
}
?>