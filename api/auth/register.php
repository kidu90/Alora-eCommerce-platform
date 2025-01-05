<?php
require_once '../../dbconnection.php';

// echo "registerUser";
function registerUser($data)
{
    global $conn;

    try {

        if (!isset($data['first_name']) || !isset($data['email']) || !isset($data['password'])) {
            http_response_code(400);
            return [
                "status" => "error",
                "message" => "All fields are required"
            ];
        }

        $first_name = $data['first_name'];
        $last_name = $data['last_name'] ?? '';
        $email = $data['email'];
        $password = $data['password'];

        // Check if user already exists
        $checkSql = "SELECT * FROM users WHERE email = ?";
        $checkStmt = $conn->prepare($checkSql);
        if (!$checkStmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $checkStmt->bind_param("s", $email);

        if (!$checkStmt->execute()) {
            throw new Exception("Execute failed: " . $checkStmt->error);
        }

        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) {
            http_response_code(400);
            return [
                "status" => "error",
                "message" => "User already exists"
            ];
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashedPassword);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        http_response_code(201);
        return [
            "status" => "success",
            "message" => "User registered successfully"
        ];
    } catch (Exception $e) {
        http_response_code(500);
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    }
}


header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    $response = registerUser($inputData);
    echo json_encode($response);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
}
