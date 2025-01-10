<?php
require_once '../../dbconnection.php';

function getAllCategories()
{
    global $conn;

    try {
        $sql = "SELECT category_id, name, description FROM categories";
        $result = $conn->query($sql);

        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return [
            "status" => "success",
            "data" => $categories
        ];
    } catch (Exception $e) {
        http_response_code(500);
        return [
            "status" => "error",
            "message" => "Failed to fetch categories",
            "error" => $e->getMessage()
        ];
    }
}

function getCategoryById($categoryId)
{
    global $conn;

    try {
        $sql = "SELECT category_id, name, description FROM categories WHERE category_id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $categoryId);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $category = $result->fetch_assoc();
            return [
                "status" => "success",
                "data" => $category
            ];
        } else {
            throw new Exception("Category with ID $categoryId not found.");
        }
    } catch (Exception $e) {
        http_response_code($e->getMessage() === "Category with ID $categoryId not found." ? 404 : 500);
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

// Check if 'category_id' is provided in the URL
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

    // Fetch category by ID
    $response = getCategoryById($categoryId);
} else {
    // Fetch all categories
    $response = getAllCategories();
}

echo json_encode($response);
