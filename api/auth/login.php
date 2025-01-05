<?php
require_once '../../dbconnection.php';
session_start();

function loginUser($data)
{
    global $conn;

    try {
        if (!isset($data['email']) || !isset($data['password'])) {
            http_response_code(400);
            return [
                "status" => "error",
                "message" => "Email and password are required"
            ];
        }

        $email = $data['email'];
        $password = $data['password'];

        // Check if user exists
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            http_response_code(401);
            return [
                "status" => "error",
                "message" => "Invalid email or password"
            ];
        }

        $user = $result->fetch_assoc();
        if (!password_verify($password, $user['password'])) {
            http_response_code(401);
            return [
                "status" => "error",
                "message" => "Invalid email or password"
            ];
        }

        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['ROLE'] = $user['role'];

        http_response_code(200);
        return [
            "status" => "success",
            "message" => "Login successful",
            "user" => [
                "id" => $user['user_id'],
                "first_name" => $user['first_name'],
                "email" => $user['email'],
                "role" => $user['role']
            ]
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
    $response = loginUser($inputData);
    echo json_encode($response);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
}
