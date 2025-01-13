<?php
require_once '../../dbconnection.php';

function createCategory($name, $description)
{
    global $conn;

    try {
        $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $name, $description);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        return [
            "status" => "success",
            "message" => "Category created successfully",
            "category_id" => $stmt->insert_id
        ];
    } catch (Exception $e) {
        http_response_code(500);
        return [
            "status" => "error",
            "message" => "Failed to create category",
            "error" => $e->getMessage()
        ];
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
    }
}

header('Content-Type: application/json');

// Get data from the request (assuming JSON input)
$data = json_decode(file_get_contents('php://input'), true);

// Validate input
if (isset($data['name']) && isset($data['description'])) {
    $name = trim($data['name']);
    $description = trim($data['description']);

    if (empty($name) || empty($description)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Name and description are required"
        ]);
        exit();
    }

    // Create the category
    $response = createCategory($name, $description);
} else {
    http_response_code(400);
    $response = [
        "status" => "error",
        "message" => "Invalid input: Name and description are required"
    ];
}

echo json_encode($response);
