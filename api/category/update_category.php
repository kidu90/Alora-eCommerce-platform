<?php
require_once '../../dbconnection.php';

function updateCategory($categoryId, $name, $description)
{
    global $conn;

    try {
        $sql = "UPDATE categories SET name = ?, description = ? WHERE category_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssi", $name, $description, $categoryId);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        if ($stmt->affected_rows === 0) {
            throw new Exception("No category found with ID $categoryId or no changes made.");
        }

        return [
            "status" => "success",
            "message" => "Category updated successfully"
        ];
    } catch (Exception $e) {
        http_response_code(500);
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
    }
}

header('Content-Type: application/json');

// Decode JSON input if POST data is empty
if (empty($_POST)) {
    $_POST = json_decode(file_get_contents('php://input'), true);
}

// Validate and fetch data from the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = isset($_POST['category_id']) ? filter_var($_POST['category_id'], FILTER_VALIDATE_INT) : null;
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;

    if ($categoryId === null || $categoryId <= 0 || !$name || !$description) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid input: category_id, name, and description are required"
        ]);
        exit();
    }

    // Update the category
    $response = updateCategory($categoryId, $name, $description);
    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method. Use POST."
    ]);
}
