<?php
require_once '../../dbconnection.php';

function deleteCategory($categoryId)
{
    global $conn;

    try {

        $sql = "DELETE FROM categories WHERE category_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $categoryId);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // Check if any row was affected
        if ($stmt->affected_rows > 0) {
            return [
                "status" => "success",
                "message" => "Category deleted successfully"
            ];
        } else {
            throw new Exception("No category found with ID $categoryId");
        }
    } catch (Exception $e) {
        http_response_code($e->getMessage() === "No category found with ID $categoryId" ? 404 : 500);
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

// Validate and retrieve the category ID from the URL
if (isset($_GET['category_id'])) {
    $categoryId = filter_var($_GET['category_id'], FILTER_VALIDATE_INT);

    if ($categoryId === false || $categoryId <= 0) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid category ID provided"
        ]);
        exit();
    }

    // Delete the category
    $response = deleteCategory($categoryId);
} else {
    http_response_code(400);
    $response = [
        "status" => "error",
        "message" => "Category ID is required in the URL"
    ];
}

echo json_encode($response);
