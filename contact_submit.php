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

// Get and sanitize values
$name        = trim((string)($data["name"] ?? ""));
$email       = trim((string)($data["email"] ?? ""));
$requestType = trim((string)($data["requestType"] ?? "General"));
$message     = trim((string)($data["message"] ?? ""));

// Validation (based on your DB column limits)
if ($name === "" || mb_strlen($name) > 100) {
    http_response_code(400);
    echo json_encode(["ok"=>false, "error"=>"Invalid name"]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
    http_response_code(400);
    echo json_encode(["ok"=>false, "error"=>"Invalid email"]);
    exit;
}

if ($requestType === "" || mb_strlen($requestType) > 50) {
    http_response_code(400);
    echo json_encode(["ok"=>false, "error"=>"Invalid request type"]);
    exit;
}

if ($message === "" || mb_strlen($message) > 5000) {
    http_response_code(400);
    echo json_encode(["ok"=>false, "error"=>"Invalid message"]);
    exit;
}

try {
    $stmt = $db->prepare("
        INSERT INTO `Request` (`name`, `email`, `requestType`, `message`)
        VALUES (:name, :email, :requestType, :message)
    ");

    $stmt->execute([
        "name"        => $name,
        "email"       => $email,
        "requestType" => $requestType,
        "message"     => $message,
    ]);

    http_response_code(201);
    echo json_encode([
        "ok" => true,
        "message" => "Request submitted successfully"
    ]);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "ok" => false,
        "error" => "Server error"
    ]);
}
