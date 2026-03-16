<?php
declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");

require __DIR__ . "/db.php";

// Only allow GET
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(405);
    echo json_encode([
        "ok" => false,
        "error" => "Method not allowed"
    ]);
    exit;
}

$email = trim((string)($_GET["email"] ?? ""));

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        "ok" => false,
        "error" => "Valid email is required"
    ]);
    exit;
}

try {
    $stmt = $db->prepare("
        SELECT `userID`, `fullName`, `email`, `phone`, `title`, `dob`
        FROM `Users`
        WHERE `email` = :email
        LIMIT 1
    ");

    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        http_response_code(404);
        echo json_encode([
            "ok" => false,
            "error" => "User not found"
        ]);
        exit;
    }

    echo json_encode([
        "ok" => true,
        "user" => $user
    ]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "ok" => false,
        "error" => "Server error"
    ]);
}
