<?php
declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");

require __DIR__ . "/db.php";

// Only allow POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode([
        "ok" => false,
        "error" => "Method not allowed"
    ]);
    exit;
}

// Support both JSON and normal form POST
$incomingJson = json_decode(file_get_contents("php://input"), true);
$data = (is_array($incomingJson) && !empty($incomingJson)) ? $incomingJson : $_POST;

$email    = trim((string)($data["email"] ?? ""));
$fullName = trim((string)($data["fullName"] ?? ""));
$phone    = trim((string)($data["phone"] ?? ""));
$title    = trim((string)($data["title"] ?? ""));
$dob      = trim((string)($data["dob"] ?? "")); // YYYY-MM-DD or blank

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "Valid email is required"]);
    exit;
}

// Validate lengths (based on your DB column sizes)
if ($fullName !== "" && mb_strlen($fullName) > 100) {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "fullName too long (max 100)"]);
    exit;
}

if ($phone !== "" && mb_strlen($phone) > 20) {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "phone too long (max 20)"]);
    exit;
}

if ($title !== "" && mb_strlen($title) > 10) {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "title too long (max 10)"]);
    exit;
}

// Validate DOB format if provided
if ($dob !== "" && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "dob must be YYYY-MM-DD"]);
    exit;
}

try {
    $stmt = $db->prepare("
        UPDATE `Users`
        SET
          `fullName` = :fullName,
          `phone`    = :phone,
          `title`    = :title,
          `dob`      = :dob
        WHERE `email` = :email
    ");

    $stmt->execute([
        "fullName" => ($fullName === "") ? null : $fullName,
        "phone"    => ($phone === "") ? null : $phone,
        "title"    => ($title === "") ? null : $title,
        "dob"      => ($dob === "") ? null : $dob,
        "email"    => $email
    ]);

    // If no rows updated, either email not found OR same values submitted
    if ($stmt->rowCount() === 0) {
        // Check if user exists
        $check = $db->prepare("SELECT 1 FROM `Users` WHERE `email` = :email LIMIT 1");
        $check->execute(["email" => $email]);
        $exists = $check->fetchColumn();

        if (!$exists) {
            http_response_code(404);
            echo json_encode(["ok" => false, "error" => "User not found"]);
            exit;
        }
    }

    echo json_encode(["ok" => true, "message" => "Profile updated"]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["ok" => false, "error" => "Server error"]);
}
